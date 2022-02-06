<?php

namespace App\Http\Controllers\Api\Store;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\BaseController;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
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
        $input = $request->all();
        $orders = Order::with('customer')->with('product')->with('category')
        ->where('store_id', Auth::guard('store')->user()->id);
        if(isset($input['type']) && $input['type'] == 0){
            $orders = $orders->whereNull('code')->orderBy('created_at','desc')->paginate(10);
        }
        else if(isset($input['type']) && $input['type'] == 1){
            $orders =   $orders->where('code', '!=', null)->orderBy('created_at','desc')->paginate(10);
        } else {
            $orders = $orders->orderBy('created_at','desc')->paginate(10);
        }

        return $this->successResponse($orders);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $orders = [];
        $input =  $request->all();
        
        if(isset($input['keyword'])){
            $orders = Order::with('customer')->whereHas('customer', function ($query) use ($request){
                $query->where('serial_number', 'like', $request->get('keyword').'%');
            })->where('store_id', Auth::guard('store')->user()->id)->take(5)->get();
        }
        return $this->successResponse($orders);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate store info
        $validator = Validator::make($request->all(), [
            'store_id' => 'required',
            'phone.*.customer' => 'required',
            'name.*.customer' => 'required',
            'serial_number.*.customer' => 'required|string|max:15|unique:customers,serial_number',
            'product_id' => 'required',
            'category_id' => 'required|integer',
        ]);

        if ($validator->fails())
            return $this->failedResponse($validator->errors()->first());

        $customer = customer::updateOrCreate(
            ['serial_number' => $request['customer']['serial_number']],
            [
                'name' => $request['customer']['name'], 
                'phone' => $request['customer']['phone'], 
            ],
        );

        $input = $request->except(['customer']);
        $input['customer_id'] = $customer->id;
        $order = Order::create($input);

        $created_at = Carbon::create($order->created_at);
        $order->end_date = $created_at->addYears(2); 
        $order->save();
        return $this->successResponse([
            'message' => 'تم انشاء العملية بنجاح',
            'data' => $order
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('store.emirate')->with('store.city')
                ->with('customer')->with('product')->with('category')
                ->where('id', $id)->first();

        if(!$order){
            return $this->failedResponse('هذه العملية ليست موجوده');
        }

        return $this->successResponse($order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $order = Order::find($id);
        if(!$order){
            return $this->failedResponse('المعذره علمية الضمان هذه ليست موجوده');

        }
        // validate store info
        $validator = Validator::make($request->all(), [
            'store_id' => 'required',
            'phone.*.customer' => 'required',
            'name.*.customer' => 'required',
            'serial_number.*.customer' => 'required',
            'product_id' => 'required ',
            'category_id' => 'required|integer',
            'cuases' => 'required'
        ]);

        if ($validator->fails())
            return $this->failedResponse($validator->errors()->first());

        if(isset($order->code) && $order->code != null)
            return $this->failedResponse('لقد تم استبدال بطارية لهذا العميل مسبقا وتاريخ تبديل البطارية كان في ' .  Carbon::parse($order->amended_at)->format('d/m/Y'));

        $order = Order::where('id', $id)
            ->update([
                'product_id' => $request->product_id,
                'category_id' => $request->category_id,
                'amended_at' => Carbon::now(),
                'cuases' => $request->cuases,
                'others' => $request->others,
                'code' => random_int(100000,999999)
            ]);

        return $this->successResponse([
            'message' => 'تم استبدلة العملية بنجاح',
            'data' => $order
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
