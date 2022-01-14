<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmirateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 
Route::get('/', function () { return redirect('login'); });

Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('login', [LoginController::class,'login']);
// Route::post('register', [RegisterController::class,'register']);
Route::get('storage/app/public/{id}/{conversion}/{filename?}', 'UploadController@storage');

// Route::get('password/forget',  function () { 
// 	return view('pages.forgot-password'); 
// })->name('password.forget');
// Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
// Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
// Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('password.update');


Route::group(['middleware' => 'auth'], function(){
	// logout route
	Route::get('/logout', [LoginController::class,'logout']);
	Route::get('/clear-cache', [HomeController::class,'clearCache']);

// 	// dashboard route  
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

	//only those have manage_user permission will get access
	Route::group(['middleware' => 'can:manage_user'], function(){
	Route::get('/users', [UserController::class,'index']);
	
	Route::get('/user/get-list', [UserController::class,'getUserList']);
		Route::get('/user/create', [UserController::class,'create']);
		Route::post('/user/create', [UserController::class,'store'])->name('create-user');
		Route::get('/user/{id}', [UserController::class,'edit']);
		Route::post('/user/update', [UserController::class,'update']);
		Route::get('/user/delete/{id}', [UserController::class,'delete']);
	});

// 	//only those have manage_role permission will get access
	Route::group(['middleware' => 'can:manage_role|manage_user'], function(){
		Route::get('/roles', [RolesController::class,'index']);
		Route::get('/role/get-list', [RolesController::class,'getRoleList']);
		Route::post('/role/create', [RolesController::class,'create']);
		Route::get('/role/edit/{id}', [RolesController::class,'edit']);
		Route::post('/role/update', [RolesController::class,'update']);
		Route::get('/role/delete/{id}', [RolesController::class,'delete']);
	});


	//only those have manage_permission permission will get access
	Route::group(['middleware' => 'can:manage_permission|manage_user'], function(){
		Route::get('/permission', [PermissionController::class,'index']);
		Route::get('/permission/get-list', [PermissionController::class,'getPermissionList']);
		Route::post('/permission/create', [PermissionController::class,'create']);
		Route::get('/permission/update', [PermissionController::class,'update']);
		Route::get('/permission/delete/{id}', [PermissionController::class,'delete']);
	});

	// get permissions
	Route::get('get-role-permissions-badge', [PermissionController::class,'getPermissionBadgeByRole']);


	Route::group(['middleware' => 'can:manage_projects'], function(){
		Route::get('categories', [CategoryController::class,'index']);
		Route::get('categories/get-categories', [CategoryController::class,'getCategorList']);
		Route::get('/categories/create', [CategoryController::class,'create']);
		Route::post('/categories/create', [CategoryController::class,'store'])->name('create-category');
		Route::get('/categories/{id}', [CategoryController::class,'edit']);
		Route::post('/categories/update', [CategoryController::class,'update'])->name('update-category');
		Route::get('/categories/delete/{id}', [CategoryController::class,'destroy']);
	});

	//products
	Route::resource('products', 'ProductController')->except([
        'show'
    ]);
	Route::get('products/delete/{id}', 'ProductController@destroy')
     ->name('products.destroy');
	Route::get('products/get-products', [ProductController::class,'getProductList']);
	
	//emirates
	Route::resource('emirates', 'EmirateController')->except([
        'show'
    ]);
	Route::get('emirates/get-emirates', [EmirateController::class,'getEmirateList']);

	//cities
	Route::resource('cities', 'CityController')->except([
        'show'
    ]);
	Route::get('cities/get-cities', [CityController::class,'getCityList']);
	
	//stores
	Route::resource('stores', 'StoreController')->except([
        'show'
    ]);
	Route::get('stores/get-stores', [StoreController::class,'getStoreList']);
	Route::get('getCitesByEmirate', [CityController::class,'getCitesByEmirate']);

	Route::resource('orders', 'OrderController')->except([
        'show'
    ]);
	Route::get('orders/get-orders', [OrderController::class,'getOrderList']);

	//settings
	Route::resource('settings', 'SettingController')->except([
        'show'
    ]);

	// permission examples
    Route::get('/permission-example', function () {
    	return view('permission-example'); 
    });
    // API Documentation
    Route::get('/rest-api', function () { return view('api'); });
    // Editable Datatable
	Route::get('/table-datatable-edit', function () { 
		return view('pages.datatable-editable'); 
	});

	
});


// Route::get('/register', function () { return view('pages.register'); });
// Route::get('/login-1', function () { return view('pages.login'); });
