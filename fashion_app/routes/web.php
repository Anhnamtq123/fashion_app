<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Route hiển thị form đăng nhập
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('formLogin');

// Route xử lý đăng nhập
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout',[LoginController::class, 'logout'])->name('logout');

// Nhóm route cần đăng nhập mới truy cập được
Route::group(['middleware'=>'auth'],function()
{

    Route::get('/home',[HomeController::class,'index']);
    Route::group(['middleware'=>'role'],function(){
        // Route::get('/admin',[AdminController::class,'index']);

        Route::group(['prefix' => 'admin'],function(){
            Route::get('/',[AdminController::class,'index'])->name('admin');

            Route::get('products', [AdminController::class,'products'])->name('admin.products');
            Route::get('products/search', [ProductController::class,'search'])->name('admin.products.search');
            Route::get('products/searchAjax', [ProductController::class,'searchAjax'])->name('admin.products.searchAjax');
            Route::resource('product', ProductController::class);

            Route::get('/orders',[AdminController::class,'orders'])->name('admin.orders');
            Route::resource('order', OrderController::class);

            Route::get('/customers',[AdminController::class,'customers'])->name('admin.customers');
            Route::get('customers/searchAjax', [CustomerController::class,'searchAjax'])->name('admin.customers.searchAjax');
            Route::resource('customer', CustomerController::class);
        });

    });
    
});
