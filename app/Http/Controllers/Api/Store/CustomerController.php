<?php

namespace App\Http\Controllers\Api\Store;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\BaseController;

use Illuminate\Support\Facades\Validator;

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
        // $customer = Customer::where('serial_number', 'like', '%' . $request->get('serial_number') . '%')->whereHas('customer', function ($query) use ($request){
        //     $query->where('serial_number', 'like', '%'.$request->get('keyword').'%');
        // })->get();
        $customer = Customer::where('serial_number', 'like', '%' . $request->get('serial_number') . '%')->get();

        return $this->successResponse($customer);
    }

}
