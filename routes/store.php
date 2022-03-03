<?php

use Illuminate\Support\Facades\Route;

//    store auth routes
Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::post('send_reset_code_email', 'AuthController@sendResetCodeEmail');
Route::post('verify_code_reset_password', 'AuthController@verifyCodeResetPassword');

Route::middleware('auth:store')->group(function () {
    Route::post('logout', 'AuthController@logout');
    Route::get('refresh', 'AuthController@refresh');
    Route::put('store-update/{id}', 'AuthController@update');
    
    Route::resource('sales', 'OrderController');
    Route::get('sales-search', 'OrderController@search');
    Route::get('customers', 'CustomerController@index');
});
