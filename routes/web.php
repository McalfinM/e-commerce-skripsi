<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
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
    Route::get('/order-history', [PaymentController::class, 'order_history'])->name('order_history');
    Route::post('/bidding-price', [OrderController::class, 'bidding_price'])->name('bidding_price');
});
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::group(['prefix' => 'product'], function () {
        Route::get('/create', [ProductController::class, 'create'])->name('create_product');
        Route::post('/create_process', [ProductController::class, 'create_process'])->name('create_product_process');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [AdminController::class, 'user_control'])->name('user_control');
        Route::get('/company-register', [AuthController::class, 'company_register'])->name('company_register');
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('/request-price-order', [AdminController::class, 'list_request_bidding'])->name('list_request_bidding');
        Route::get('/detail-bidding-request/{id}', [AdminController::class, 'detail_request_bidding'])->name('detail_request_bidding');
        Route::post('/send-bidding/{id}', [AdminController::class, 'send_bidding_price'])->name('send_bidding_price');
        Route::post('/deal/{id}', [AdminController::class, 'bidding_deal'])->name('bidding_deal_admin');
        Route::get('/print/{id}', [AdminController::class, 'list_order_inventory_pdf'])->name('list_order_inventory_pdf');
        Route::get('/surat_jalan/{id}', [AdminController::class, 'surat_jalan_pdf'])->name('surat_jalan_pdf');
        Route::post('/success_order/{id}', [AdminController::class, 'success_order'])->name('success_order');
    });
});

Route::group(['middleware' => 'company', 'prefix' => 'company'], function () {

    Route::get('/dashboard', [CompanyController::class, 'dashboard'])->name('company_dashboard');
    Route::get('/shop', [CompanyController::class, 'index'])->name('company_shop');
    Route::group(['prefix' => 'order'], function () {
        Route::get('/', [CompanyController::class, 'order'])->name('company_order');
        Route::get('/company-request-price-order/{id}', [OrderController::class, 'company_request_price_order'])->name('company_request_price_order');
        Route::get('/bidding-request', [CompanyController::class, 'request_price_order'])->name('request_price_order');
        Route::get('/detail-bidding-request/{id}', [CompanyController::class, 'detail_list_bidding_price'])->name('detail_list_bidding_price');
        Route::post('/send-bidding/{id}', [CompanyController::class, 'request_bidding_price'])->name('request_bidding_price');
        Route::post('/deal/{id}', [CompanyController::class, 'bidding_deal'])->name('bidding_deal_company');
        Route::post('/volume-update', [OrderController::class, 'volume_update'])->name('volume_update');
    });
    Route::post('/cart-update', [OrderController::class, 'cart_update'])->name('cart_update');
    Route::get('/delete-item/{id}', [OrderController::class, 'delete_item'])->name('delete_item');
});
