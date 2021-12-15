<?php

namespace App\Repositories;

use App\Models\OrderDetails;

class OrderDetailRepository
{

    public function create($data)
    {
        $order = new OrderDetails();
        $order->order_id = $data['order_id'];
        $order->product_id = $data['product_id'];
        $order->quantity = $data['quantity'];
        $order->total_price = $data['total_price'];
        $order->save();

        return $order;
    }

    public function update($data)
    {
        $order = OrderDetails::where('order_id', $data['order_id'])->first();

        $order->quantity = $data['quantity'];
        $order->total_price = $data['total_price'];
        $order->update();

        return $order;
    }

    public function find_one($id)
    {
        $order = OrderDetails::where('id', $id)->first();
        return $order;
    }

    public function find_one_by_order_id_and_product_uuid($id, $product_uuid)
    {
        $order = OrderDetails::where('order_id', $id)->where('product_id', $product_uuid)->first();
        return $order;
    }

    public function find_by_id_search_with_order_created($id)
    {
        $order = OrderDetails::where('order_id', $id)->with('product')->get();
        return $order;
    }
}
