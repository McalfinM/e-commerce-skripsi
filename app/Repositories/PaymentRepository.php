<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository
{

    public function create($data)
    {
        $payment = new Payment();
        $payment->order_id = $data['order_id'];
        $payment->name = $data['name'];
        $payment->user_id = $data['user_id'];
        $payment->payment_method = $data['payment_method'];
        $payment->quantity = $data['quantity'];
        $payment->no_invoice = $data['no_invoice'];
        $payment->ppn = $data['ppn'];
        $payment->image = $data['image'];
        $payment->total_price = $data['total_price'];

        $payment->save();
        return $payment;
    }
}
