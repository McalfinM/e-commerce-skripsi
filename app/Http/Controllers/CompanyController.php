<?php

namespace App\Http\Controllers;

use App\Services\OrderDetailService;
use App\Services\OrderService;
use App\Services\PdfGenerateService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

    protected $productService;
    protected $orderService;
    protected $orderDetailService;
    protected $pdfGenerateService;
    public function __construct(
        ProductService $productService,
        OrderService $orderService,
        OrderDetailService $orderDetailService,
        PdfGenerateService $pdfGenerateService
    ) {
        $this->productService = $productService;
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
        $this->pdfGenerateService = $pdfGenerateService;
    }
    public function dashboard()
    {
        return view('company.dashboard');
    }

    public function index(Request $request)
    {
        $data = $this->productService->get_all($request->search);
        $user = Auth::user();
        $order = $this->orderService->find_one_with_user_and_status($user->id);
        if ($order) {
            $orderDetail = $this->orderDetailService->find_by_id_search_with_order_created($order->id);

            return view('company.index', compact('data', 'order', 'orderDetail'));
        } else {
            $orderDetail = null;
            return view('company.index', compact('data', 'orderDetail', 'order'));
        }
    }

    public function order()
    {
        $user = Auth::user();
        $order = $this->orderService->find_with_type_company($user->id);
        if ($order) {
            $orderDetail = $this->orderDetailService->find_by_id_search_with_order_created($order->id);

            return view('company.order', compact('order', 'orderDetail'));
        } else {
            $orderDetail = null;
            $order = null;
            return view('company.order', compact('orderDetail', 'order'));
        }
    }

    public function request_price_order()
    {
        $data = $this->orderService->find_all_with_status_request_price_or_bidding();
        return view('company.bidding_request', compact('data'));
    }

    public function detail_list_bidding_price(Request $request)
    {
        $user = Auth::user();
        $order = $this->orderService->find_one_with_status_request_price_or_bidding_company($user->id);
        if ($order) {
            $orderDetail = $this->orderDetailService->find_by_id_search_with_order_created($request->id);

            return view('company.detail_bidding_request', compact('order', 'orderDetail'));
        } else {
            $orderDetail = null;
            $order = null;
            return view('company.detail_bidding_request', compact('orderDetail', 'order'));
        }
    }

    public function request_bidding_price(Request $request)
    {
        $status = "";
        if ($request->company == 'agree') {
            $status = "Company Deal";
        } else {

            $status = 'Request Price';
        }
        $user = Auth::user();
        $this->orderService->send_bidding_price($request->id, $status, $user);
        return redirect()->back()->with('success', 'Permintaan berhasil dikirim');
    }

    public function bidding_deal(Request $request)
    {
        $status = 'Deal';
        $user = Auth::user();
        $this->orderService->send_bidding_price($request->id, $status, $user);
        return redirect()->back()->with('success', 'Terima Kasih Telah memilih kami ' . Auth::user()->username);
    }

    public function change_profile(Request $request)
    {
    }

    public function lihat_pesanan_pelanggan(Request $request)
    {
        $order = $this->orderService->find_one_with_status_request_price_or_bidding($request->id);
        $orderDetail = $this->orderDetailService->find_by_id_search_with_order_created($order->id);
        $data =  $this->pdfGenerateService->lihat_pesanan_pelanggan($order, $orderDetail);
        return $data->stream();
    }
}
