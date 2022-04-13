<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{

    public function create($data)
    {
        $order = new Order();
        $order->order_number = $data['order_number'];
        $order->user_id = $data['user_id'];
        $order->status = $data['status'];
        $order->quantity = $data['quantity'];

        $order->save();

        return $order;
    }

    public function update($data)
    {
        $order = Order::where('id', $data['id'])->first();
        $order->order_number = $data['order_number'];
        $order->user_id = $data['user_id'];
        $order->status = $data['status'];
        $order->quantity = $data['quantity'];
        $order->update();
        return $order;
    }

    public function find_one_with_user_and_status($id)
    {
        $order = Order::where('user_id', $id)->where('status', 'Order Created')->first();

        return $order;
    }

    public function find_one_with_user_and_type($id)
    {
        $order = Order::where('user_id', $id)->where('status', 'Order Created')->first();

        return $order;
    }

    public function find_one_with_order_number($order_number, $user_id)
    {
        $order = Order::where('order_number', $order_number)->where('user_id', $user_id)->where('status', 'Order Created')->first();

        return $order;
    }

    public function find_one_with_order_detail_with_order_number($order_id, $user_id)
    {
        $order = Order::where('id', $order_id)->where('user_id', $user_id)->where('status', 'Order Created')->with('OrderDetail', function ($query) use ($order_id) {

            $query->where('order_id', $order_id)->get();
        })->first();

        return $order;
    }

    public function find_one_with_user_and_status_not_created($id)
    {
        $order = Order::where('user_id', $id)->where('status', 'NOT LIKE', '%Order Created%')->get();

        return $order;
    }

    public function find_with_type_company($id)
    {
        $order = Order::where('user_id', $id)->where('status', 'Order Created')->first();
        return $order;
    }

    public function company_request_price_order($id)
    {

        $order = Order::where('id', $id)->where('status', 'Order Created')->first();
        $order->status = 'Request Price';
        $order->update();
    }

    public function find_all_with_status_request_price_or_bidding()
    {
        $order = Order::where('status', '<>', 'Order Created')->get();

        return $order;
    }
    public function find_one_with_status_request_price_or_bidding_company($user_id)
    {
        $order = Order::where('user_id', $user_id)->where("status", '<>', 'Order Created')->first();

        return $order;
    }

    public function find_one_with_status_request_price_or_bidding($id)
    {
        $order = Order::where('id', $id)->where('status', '<>', 'Order Created')->first();

        return $order;
    }

    public function send_bidding_price($id, $status)
    {
        $order = Order::where('id', $id)->where('status', '<>', 'Order Created')->first();
        $order->status = $status;
        $order->update();
        return $order;
    }


    public function find_order_with_status_success($user_id)
    {
        $order = Order::where('user_id', $user_id)->where('status', '!=', 'Done')->first();
        return $order;
    }
}
