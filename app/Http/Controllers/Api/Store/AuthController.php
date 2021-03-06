<?php

namespace App\Http\Controllers\Api\Store;

use App\Models\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Support\Facades\Hash;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;

class AuthController extends BaseController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:store', ['except' => ['login', 'register', 'sendResetCodeEmail', 'verifyCodeResetPassword']]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'phone' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails())
            return $this->failedResponse($validator->errors()->first());

        $credentials = $request->only('phone', 'password');
        
        if ($token = $this->guard()->attempt($credentials)) {
            return $this->successResponse([
                'message' => 'تم تسجيل الدخول بنجاح',
                'token' =>  [
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => $this->guard()->factory()->getTTL() * 60
                ],
                'data' => $this->guard()->user()
            ]);
        }

        return $this->failedResponse('رقم التلفون او كلمة السر خاطئة');
    }


    /**
     * Create Store Information
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {

        // validate store info
        $validator = Validator::make($request->all(), [
            'name' => 'required | string ',
            'phone' => 'required|string|unique:stores,phone',
            'email' => 'required|string|unique:stores,email',
            'password' => 'required|string ',
            'emirate_id' => 'required|integer',
            'city_id' => 'required|integer',
            'street' => 'required|string',
        ]);

        if ($validator->fails())
            return $this->failedResponse($validator->errors()->first());

        // store user information
        $store = Store::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'emirate_id' => $request->emirate_id,
            'city_id' => $request->city_id,
            'street' => $request->street,
            'email' => $request->email,
        ]);
        if ($store) {

            if (isset($request->image)) {
                $store->addMediaFromBase64($request->image)->usingFileName(random_int(10000000,99999999).'.png')->toMediaCollection('image');
            }

            if (isset($request->commercial_register)) {
                $store->addMediaFromBase64($request->commercial_register)->usingFileName(random_int(10000000,99999999).'.png')->toMediaCollection('commercial_register');
            }

            $credentials = $request->only('phone', 'password');
            $token = $this->guard()->attempt($credentials);
            return $this->successResponse([
                'message' => 'تم إنشاء البائع بنجاح',
                'token' => [
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => $this->guard()->factory()->getTTL() * 60
                ],
                'data' => $this->guard()->user()
            ]);
        }

        return $this->failedResponse();
    }


    /**
     * Get the authenticated User
     *
     * @return JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken($this->guard()->refresh());
    }


    /**
     * Log the user out (Invalidate the token)
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->guard()->logout();

        return response()->json(['message' => 'تسجيل الخروج بنجاح']);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('store');
    }


    
    /**
     * Update Store Information
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update($id, Request $request): JsonResponse
    {
        $store = Store::find($id);

        if(!$store){
            return $this->failedResponse('عذراً، لا يوجد هذا المتجر');
        }

        // validate store info
        $validator = Validator::make($request->all(), [
            'name' => 'required|string ',
            'phone' => 'required|string|unique:stores' . ',id,' . $id,
            'email' => 'required|string|email|max:255|unique:stores' . ',id,' . $id,
            'emirate_id' => 'required|integer',
            'city_id' => 'required|integer',
            'street' => 'required|string',
        ]);

        if ($validator->fails())
            return $this->failedResponse($validator->errors()->first());

        // update user information
        Store::where('id', $id)
        ->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'emirate_id' => $request->emirate_id,
            'city_id' => $request->city_id,
            'street' => $request->street,
            'email' => $request->email,
        ]);
        $store = Store::find($id);

        if ($store) {

            if (isset($request->image)) {
                if($store->hasMedia('image')){
                    $store->getFirstMedia('image')->delete();
                }
                $store->addMediaFromBase64($request->image)->usingFileName(random_int(10000000,99999999).'.png')->toMediaCollection('image');
            }

            if (isset($request->commercial_register)) {
                if($store->hasMedia('commercial_register')){
                    $store->getFirstMedia('commercial_register')->delete();
                }
                $store->addMediaFromBase64($request->commercial_register)->usingFileName(random_int(10000000,99999999).'.png')->toMediaCollection('commercial_register');
            }

            return $this->successResponse([
                'message' => 'تم تحديث البائع بنجاح',
                'data' => Store::find($id) 
            ]);
        }

        return $this->failedResponse();
    }




    function sendResetCodeEmail(Request $request)
    {
        // validate store info
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|exists:stores,email'
        ]);

        if ($validator->fails())
            return $this->failedResponse($validator->errors()->first());

        $store = Store::where('email', $request->input('email'))->first();

        if (!$store) {
            return $this->failedResponse('هذا المتجر ليس متوجدا');
        }

        Store::where('id', $store->id)
        ->update([
            'otp' => rand(10000, 99999)
        ]);

        try {
            Mail::to($store->email)->send(new ResetPassword(Store::find($store->id)));
        } catch (ValidatorException $e) {
            return $this->failedResponse($e->getMessage());
        }

        return $this->successResponse([
            'message' => 'تم إرسال كود إعادة تعيين كلمة السر بنجاح'
        ]);
    }
    

    function verifyCodeResetPassword(Request $request)
    {
        // validate store info
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|exists:stores,email',
            'otp' => 'required|string|exists:stores,otp',
            'password' => 'required|string'
        ]);

        if ($validator->fails())
            return $this->failedResponse($validator->errors()->first());
        
        $store = Store::where('email', $request->input('email'))->first();

        if (!$store) {
            return $this->failedResponse('هذا المتجر ليس متوجدا');
        }

        try {
            if ($request->input('otp') != null && $request->input('otp') == $store->otp) {
                Store::where('id', $store->id)
                ->update([
                    'otp' => null,
                    'password' => Hash::make($request->input('password'))
                ]);
            } else {
                return $this->failedResponse('كود التحقق غير صحيح');
            }
        } catch (ValidatorException $e) {
            return $this->failedResponse($e->getMessage());
        }

        return $this->successResponse([
            'message' => 'تم تغير كلمة السر بنجاح'
        ]);
    }

}
