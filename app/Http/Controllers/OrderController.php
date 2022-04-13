<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckOngkirRequest;
use App\Http\Requests\CompleteOrderRequest;
use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Services\OrderDetailService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

        $auth = Auth::user();
        $data = $this->orderService->company_request_price_order($request->id, $auth);
        if ($data && $data->status() == 302) {
            return redirect()->back();
        } else {

            return redirect()->back()->with('success', 'Data berhasil dikirim');
        }
    }

    public function bidding_price(Request $request)
    {
        $id = $request->input('id');
        $user = Auth::user();
        $data = $this->orderDetailService->bidding_price($id, $request, $user);

        return $data;
    }

    public function volume_update(Request $request)
    {
        $id = $request->input('id');
        $data = $this->orderDetailService->volume_update($id, $request);
        return $data;
    }

    public function complete_data(CompleteOrderRequest $request)
    {
        $file_name = "";
        if ($request->file('surat_jalan')) {
            $sertifikat = $request->file('surat_jalan');
            $file_name = Str::random(20) . '.' . $sertifikat->extension();
            $sertifikat->move('pdf/surat_jalan', $file_name);
        }

        $order = Order::where('order_number', $request->order_number)->first();
        $order->surat_jalan = $file_name;
        $order->address = $request->address;
        $order->pic_name = $request->pic_name;
        $order->update();

        return redirect()->back()->with('success', 'Data berhasil di update');
    }
}
