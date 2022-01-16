<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Validator;

class OrderApiController extends BaseController
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::with('store')->with('product')->with('category')
        ->whereHas('customer', function ($query) use ($request){
            $query->where('serial_number', $request->get('serial_number'));
        })->get();
        return $this->successResponse($orders);
    }


    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('store.emirate')->with('store.city')->with('product')->with('category')
        ->where('id', $id)->first();

        if(!$order){
            return $this->failedResponse('هذه العملية ليست موجوده');
        }

        return $this->successResponse($order);
    }


}
