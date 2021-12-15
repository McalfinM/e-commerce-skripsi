<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckOngkirRequest;
use App\Http\Requests\CreateOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
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
}
