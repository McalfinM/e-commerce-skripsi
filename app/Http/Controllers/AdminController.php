<?php

namespace App\Http\Controllers;

use App\Services\OrderDetailService;
use App\Services\OrderService;
use App\Services\PdfGenerateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $orderService;
    protected $orderDetailService;
    protected $pdfGenerateService;
    public function __construct(OrderService $orderService, OrderDetailService $orderDetailService, PdfGenerateService $pdfGenerateService)
    {
        $this->orderService = $orderService;
        $this->pdfGenerateService = $pdfGenerateService;
        $this->orderDetailService = $orderDetailService;
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function user_control()
    {
        return view('admin.user.index');
    }

    public function list_request_bidding()
    {
        $data = $this->orderService->find_all_with_status_request_price_or_bidding();

        if ($data) {
            return view('admin.order.bidding_request', compact('data'));
        } else {
            $data = null;
            return view('admin.order.bidding_request', compact('data'));
        }
    }

    public function detail_request_bidding(Request $request)
    {

        $order = $this->orderService->find_one_with_status_request_price_or_bidding($request->id);

        if ($order) {
            $orderDetail = $this->orderDetailService->find_by_id_search_with_order_created($order->id);

            return view('admin.order.detail_bidding_request', compact('order', 'orderDetail'));
        } else {
            $orderDetail = null;
            $order = null;
            return view('admin.order.detail_bidding_request', compact('orderDetail', 'order'));
        }
    }

    public function send_bidding_price(Request $request)
    {
        $status = 'Bidding';
        $user = Auth::user();
        $this->orderService->send_bidding_price($request->id, $status, $user);
        return redirect()->back()->with('success', 'Data berhasil di kirim');
    }

    public function bidding_deal(Request $request)
    {
        $status = 'Processed';
        $user = Auth::user();
        $this->orderService->send_bidding_price($request->id, $status, $user);
        return redirect()->route('list_request_bidding')->with('success', 'Data disetujui');
    }

    public function list_order_inventory_pdf(Request $request)
    {
        $order = $this->orderService->find_one_with_status_request_price_or_bidding($request->id);
        $orderDetail = $this->orderDetailService->find_by_id_search_with_order_created($order->id);
        $data =  $this->pdfGenerateService->list_order_inventory($order, $orderDetail);
        return $data->stream();
    }

    public function surat_jalan_pdf(Request $request)
    {
        $order = $this->orderService->find_one_with_status_request_price_or_bidding($request->id);
        $orderDetail = $this->orderDetailService->find_by_id_search_with_order_created($order->id);
        $data =  $this->pdfGenerateService->surat_jalan_pdf($order, $orderDetail);
        return $data->stream();
    }

    public function success_order(Request $request)
    {
        $status = 'Done';
        $user = Auth::user();
        $this->orderService->send_bidding_price($request->id, $status, $user);
        return redirect()->route('list_request_bidding')->with('success', 'Order Berhasil Diselesaikan');
    }
}
