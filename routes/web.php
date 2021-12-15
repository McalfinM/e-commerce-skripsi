<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
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

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register_process', [AuthController::class, 'register_process'])->name('register_process');
Route::post('/login_process', [AuthController::class, 'login_process'])->name('login_process');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/products/{slug}', [HomeController::class, 'product_detail'])->name('product_detail');
Route::get('/cities/{id}', [LocationController::class, 'get_all_city_from_province'])->name('get_all_city_from_province');
Route::get('/districts/{id}', [LocationController::class, 'get_all_district_from_city'])->name('get_all_city_from_city');
Route::get('/city/province/{id}', [LocationController::class, 'get_city_from_province_rajaongkir'])->name('city_rajaongkir');
Route::post('/cost', [OrderController::class, 'check_cost'])->name('check_cost');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/add-to-cart', [OrderController::class, 'createOrUpdate'])->name('createOrUpdate_order');
    Route::get('/carts', [HomeController::class, 'cart'])->name('cart');
    Route::get('/checkout/{order_number}', [HomeController::class, 'checkout'])->name('checkout');
    Route::get('/history-order', [HomeController::class, 'history-order'])->name('history_order');
    Route::post('/payment/{id}', [PaymentController::class, 'create_payment'])->name('create_payment');
});
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::group(['prefix' => 'product'], function () {
        Route::get('/create', [ProductController::class, 'create'])->name('create_product');
        Route::post('/create_process', [ProductController::class, 'create_process'])->name('create_product_process');
    });
});
