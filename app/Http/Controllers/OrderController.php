<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckOngkirRequest;
use App\Http\Requests\CreateOrderRequest;
use App\Services\OrderDetailService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $orderService, $orderDetailService;

    public function __construct(OrderService $orderService, OrderDetailService $orderDetailService)
    {
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
    }

    public function createOrUpdate(CreateOrderRequest $request)
    {
        $user = Auth::user();
        // dd($request, $user);
        $this->orderService->createOrUpdate($request, $user);
        return redirect()->back()->with('success', 'Berhasil masukan ke keranjang');
    }

    public function cart()
    {
        $user = Auth::user();
        $this->orderService->find_one_with_user_and_status($user);
    }

    public function check_cost(CheckOngkirRequest $request)
    {

        $data = $this->orderService->check_cost($request);
        return $data;
    }

    public function cart_update(Request $request)
    {

        $id = $request->input('id');

        $data = $this->orderDetailService->updateQuantity($id, $request);
        // return redirect()->back()->with('success', 'update');
    }

    public function delete_item(Request $request)
    {


        $data = $this->orderDetailService->delete_item($request->id);
        return redirect()->back()->with('success', 'item berhasil di hapus');
    }

    public function company_request_price_order(Request $request)
    {
        $data = $this->orderService->company_request_price_order($request->id);
        return redirect()->back()->with('success', 'List Barang dikirim');
    }

    public function bidding_price(Request $request)
    {
        $id = $request->input('id');
        $data = $this->orderDetailService->bidding_price($id, $request);
        return $data;
    }

    public function volume_update(Request $request)
    {
        $id = $request->input('id');
        $data = $this->orderDetailService->volume_update($id, $request);
        return $data;
    }
}
