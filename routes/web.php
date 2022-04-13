<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LoginSecurityController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TwoFAController;
use Illuminate\Http\Client\Request;
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
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/products/{slug}', [HomeController::class, 'product_detail'])->name('product_detail');
Route::post('/cost', [OrderController::class, 'check_cost'])->name('check_cost');
Route::group(['middleware' => ['auth']], function () {
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

Route::group(['middleware' => ['auth', '2fa', 'company'], 'prefix' => 'company'], function () {

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
        Route::post('/complete-data/{order_number}', [OrderController::class, 'complete_data'])->name('complete_data');
        Route::get('/lihat_pesanan/{id}', [CompanyController::class, 'lihat_pesanan_pelanggan'])->name('lihat_pesanan_pelanggan');
    });
    Route::post('/cart-update', [OrderController::class, 'cart_update'])->name('cart_update');
    Route::get('/delete-item/{id}', [OrderController::class, 'delete_item'])->name('delete_item');

    Route::group(['prefix' => '2fa'], function () {
        Route::get('/', [LoginSecurityController::class, 'show2faForm'])->name('form2fa');
        Route::post('/generateSecret', [LoginSecurityController::class, 'generate2faSecret'])->name('generate2faSecret');
        Route::post('/enable2fa', [LoginSecurityController::class, 'enable2fa'])->name('enable2fa');
        Route::post('/disable2fa', [LoginSecurityController::class, 'disable2fa'])->name('disable2fa');

        // 2fa middleware
        Route::post('/2faVerify', function () {
            return redirect(URL()->previous());
        })->name('2faVerify')->middleware('2fa');
    });
});
Route::get('2fa', [TwoFAController::class, 'index'])->name('2fa.index');
Route::post('2fa', [TwoFAController::class, 'create'])->name('2fa.post');
Route::get('2fa/reset', [TwoFAController::class, 'resend'])->name('2fa.resend');
