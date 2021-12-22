<?php

namespace App\Services;

use App\Repositories\PaymentRepository;

class PaymentService
{

    protected $paymentRepository, $orderService, $orderDetailService;

    public function __construct(PaymentRepository $paymentRepository, OrderService $orderService, OrderDetailService $orderDetailService)
    {
        $this->paymentRepository = $paymentRepository;
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
    }

    public function create($order_id, $data, $user)
    {
        $order = $this->orderService->find_one_with_user_and_status($user->id);
        // dd($order);
        $orderDetail = $this->orderDetailService->find_by_id_search_with_order_created($order->id);
        $total_price = 0;
        foreach ($orderDetail as $detail) {
            $total_price += $detail->total_price;
        }
        $image_name = 'image.jpg';
        if ($data->file()) {
        }

        $entityPayment = [
            "order_id" => $order['id'],
            "name" => $data['name'],
            "user_id" => $user->id,
            "payment_method" => $data['payment_method'],
            "no_invoice" => 'INV/MS/' . rand(10000, 100000),
            "ppn" => 0,
            'quantity' => $order['quantity'],
            "total_price" => $total_price,
            'image' => $image_name
        ];

        $order->status = 'Processed';
        $order = $this->orderService->updateOrder($order);

        $this->paymentRepository->create($entityPayment);
    }

    public function find_one_with_user($id)
    {
        $order = $this->paymentRepository->find_one_with_user($id);

        return $order;
    }
}
