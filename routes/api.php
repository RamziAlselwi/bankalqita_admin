<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\EmirateController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\OrderApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('settings', [SettingController::class,'list']);
Route::get('warrantyTerms', [SettingController::class,'warrantyTerms']);
Route::get('instructions', [SettingController::class,'instructions']);
Route::get('companies', [SettingController::class,'companies']);
Route::get('emirates', [EmirateController::class,'list']);
Route::get('categories', [CategoryController::class,'list']);
Route::get('products', [ProductController::class,'list']);
Route::get('customers', [CustomerController::class,'index']);
Route::get('orders', [OrderApiController::class,'index']);
Route::get('orders/{id}', [OrderApiController::class,'show']);
