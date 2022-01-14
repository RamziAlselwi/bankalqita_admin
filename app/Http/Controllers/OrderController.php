<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('orders.index');
    }



    /**
     * Show Order List
     *
     * @param Request $request
     * @return mixed
     */
    public function getOrderList(Request $request)
    {
        $data = Order::with('store')->with('customer')->with('product')->get();
        return Datatables::of($data)
            ->addColumn('store', function ($data) {
                return $data->store->name;
            })
            ->addColumn('customer_name', function ($data) {
                return $data->customer ? $data->customer->name : '';
            })
            ->addColumn('customer_number', function ($data) {
                return $data->customer ? $data->customer->serial_number : '';
            })
            ->addColumn('product', function ($data) {
                return $data->product ? $data->product->name : '';
            })
            ->addColumn('created_at', function ($data) {
                $dateObj = new Carbon\Carbon($data['created_at']);
                $replace = preg_replace('/\$\{date\}/', $dateObj->format('l jS F Y (h:i:s)'), $html);
                $replace = preg_replace('/\$\{dateHuman\}/', $dateObj->diffForHumans(), $replace);
                return $replace;
            })
            ->addColumn('remaining_date', function ($data) {
                $dateObj = new Carbon\Carbon($data['remaining_date']);
                $replace = preg_replace('/\$\{date\}/', $dateObj->format('l jS F Y (h:i:s)'), $html);
                $replace = preg_replace('/\$\{dateHuman\}/', $dateObj->diffForHumans(), $replace);
                return $replace;
            })
            ->addColumn('end_date', function ($data) {
                $dateObj = new Carbon\Carbon($data['end_date']);
                $replace = preg_replace('/\$\{date\}/', $dateObj->format('l jS F Y (h:i:s)'), $html);
                $replace = preg_replace('/\$\{dateHuman\}/', $dateObj->diffForHumans(), $replace);
                return $replace;
            })
            ->addColumn('amended_at', function ($data) {
                $dateObj = new Carbon\Carbon($data['amended_at']);
                $replace = preg_replace('/\$\{date\}/', $dateObj->format('l jS F Y (h:i:s)'), $html);
                $replace = preg_replace('/\$\{dateHuman\}/', $dateObj->diffForHumans(), $replace);
                return $replace;
            })
            ->rawColumns(['store', 'customer_name', 'customer_number', 'product', 'created_at', 'remaining_date', 'end_date', 'amended_at'])
            ->make(true);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
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
    public function update(Request $request, Order $order)
    {
        //
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
