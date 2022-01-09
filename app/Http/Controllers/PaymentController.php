<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    public function create_payment($order_id, PaymentRequest $request)
    {
        // dd($order_id);
        // dd($request);
        $user = Auth::user();
        $paymentService = $this->paymentService->create($order_id, $request, $user);

        return redirect()->route('home')->with('success', 'Pembayaran Berhasil');
    }

    public function order_history()
    {
        $user = Auth::user();
        $data = $this->paymentService->find_one_with_user($user->id);
        return view('user.order_history', compact('data'));
    }
}
