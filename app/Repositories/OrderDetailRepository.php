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
        $order->previous_price = $data['previous_price'];
        $order->previous_quantity = $data['previous_quantity'];

        $order->save();

        return $order;
    }

    public function update($data)
    {
        $order = OrderDetails::where('order_id', $data['order_id'])->where('product_id', $data['product_id'])->first();

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

    public function update_quantity($id, $data)
    {

        $order = OrderDetails::where('id', $id)->first();
        // dd($order);
        $order->quantity = $data['quantity'];
        $order->update();
        return $order;
    }

    public function delete_item($id)
    {

        $order = OrderDetails::where('id', $id)->delete();
        // dd($order);

        return $order;
    }

    public function bidding_price($id, $data)
    {
        $order = OrderDetails::where('id', $id)->first();

        $order->total_price = $data['total_price'];
        $order->update();
        return $order;
    }

    public function update_previous_price($id, $data)
    {
        $order = OrderDetails::where('id', $id)->first();
        // dd($order);
        $order->previous_price = $data['total_price'];
        $order->update();
        return $order;
    }

    public function volume_update($id, $data)
    {

        $order = OrderDetails::where('id', $id)->first();
        // dd($order);
        $order->volume = $data['volume'];
        $order->update();
        return $order;
    }

    public function update_previous($id, $product_id)
    {
        $order = OrderDetails::where('order_id', $id)->where('product_id', $product_id)->first();
        $order->previous_quantity = $order['previous_quantity'];
        $order->previous_volume = $order['previous_volume'];
        $order->update();
        return $order;
    }

    public function find_with_order_id_and_product($id, $product_id)
    {
        $order = OrderDetails::where('order_id', $id)->where('product_id', $product_id)->first();
        return $order;
    }
}
