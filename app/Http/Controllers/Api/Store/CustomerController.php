<?php

namespace App\Http\Controllers\Api\Store;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\BaseController;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CustomerController extends BaseController
{
    
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:store');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customer = [];
        $input =  $request->all();

        if(isset($input['serial_number'])){
            $customer = Customer::where('serial_number', 'like', $request->get('serial_number') . '%')->whereHas('orders', function ($query) use ($request){
                    $query->where('store_id', Auth::guard('store')->user()->id);
                })->get();
        }

        return $this->successResponse($customer);
    }

}
