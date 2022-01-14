<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\City;
use App\Models\Order;
use App\Models\Store;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::take(5)->get();
        $stores_count = Store::all()->count();
        $products = Product::with('category')->take(5)->get();
        $productsCount = Product::all()->count();
        $category = Category::all()->count();
        $orders = Category::all()->count();
        return view('dashboard', compact('stores', 'stores_count', 'products', 'productsCount', 'category', 'orders'));
    }

}
