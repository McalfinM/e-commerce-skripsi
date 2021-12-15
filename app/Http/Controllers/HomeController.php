<?php

namespace App\Http\Controllers;

use App\Services\LocationService;
use App\Services\OrderDetailService;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\RajaOngkirService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    protected $productService;
    protected $orderService;
    protected $orderDetailService;
    protected $locationService;
    protected $rajaOngkirService;

    public function __construct(ProductService $productService, OrderService $orderService, OrderDetailService $orderDetailService, LocationService $locationService, RajaOngkirService $rajaOngkirService)
    {
        $this->productService = $productService;
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
        $this->locationService = $locationService;
        $this->rajaOngkirService = $rajaOngkirService;
    }

    public function home(Request $request)
    {
        $data = $this->productService->get_all($request->search);
        return view('user.home', compact('data'));
    }

    public function product_detail(Request $request)
    {
        $data = $this->productService->find_one_by_slug($request->slug);

        return view('user.product_detail', compact('data'));
    }

    public function cart()
    {
        $user = Auth::user();
        $order = $this->orderService->find_one_with_user_and_status($user->id);
        if ($order) {
            $orderDetail = $this->orderDetailService->find_by_id_search_with_order_created($order->id);
            $province = $this->rajaOngkirService->getProvince();
            $result = json_decode($province);
            return view('user.cart', compact('order', 'orderDetail', 'result'));
        } else {
            $orderDetail = null;
            return view('user.cart', compact('orderDetail'));
        }

        // dd($result->rajaongkir->results);
        // for ($i = 0; $i < count($decry->rajaongkir->dec$decry); $i++) {
        //     dd($decry->rajaongkir->dec$decry[$i]);
        // }

    }

    public function checkout($order_number)
    {
        $user = Auth::user();
        $order = $this->orderService->checkout($order_number, $user);
        $province = $this->locationService->get_all_province();
        // $result = json_decode($province);

        if (!$order) {
            return redirect()->route('home')->with('error', 'Data tidak ditemukan');
        } else {
            return view('user.checkout', compact('order', 'province'));
        }
    }

    public function history_order()
    {
        return view('user.history_order');
    }
}
