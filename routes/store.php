<?php

use Illuminate\Support\Facades\Route;

//    store auth routes
Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::middleware('auth:store')->group(function () {
    Route::post('logout', 'AuthController@logout');
    Route::get('refresh', 'AuthController@refresh');
    Route::put('store-update/{id}', 'AuthController@update');
    
    Route::resource('sales', 'OrderController');
    Route::get('sales-search', 'OrderController@search');
    Route::get('customers', 'CustomerController@index');
});
