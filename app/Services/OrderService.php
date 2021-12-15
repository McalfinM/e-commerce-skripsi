<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use DateTime;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class OrderService
{

    protected $orderRepository, $productService, $orderDetailService, $rajaOngkirService, $locationService;
    public function __construct(OrderRepository $orderRepository, ProductService $productService, OrderDetailService $orderDetailService, RajaOngkirService $rajaOngkirService, LocationService $locationService)
    {
        $this->orderRepository = $orderRepository;
        $this->productService = $productService;
        $this->orderDetailService = $orderDetailService;
        $this->rajaOngkirService = $rajaOngkirService;
        $this->locationService = $locationService;
    }

    public function createOrUpdate($data, $user)
    {
        $order = $this->orderRepository->find_one_with_user_and_status($user->id);
        if (!$order) {
            $product = $this->productService->find_one($data->product_id);
            if (!$product) {
                return redirect()->back()->with('error', 'Produk tidak ditemukan');
            }


            //create order detail with product id
            $order_entity = [
                'order_number' => 'MS' . $product->id . Str::random(4),
                'user_id' => $user->id,
                'status' => 'Order Created',
                'quantity' => 1

            ];
            $order = $this->orderRepository->create($order_entity);
            $entity = [
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'address' => "none",
                'total_price' => $product->price * 1

            ];

            $this->orderDetailService->create($entity);
            return $order;
        } else {
            //update order detail add quantity

            $product = $this->productService->find_one($data->product_id);
            if (!$product) return redirect()->back()->with('error', 'Produk tidak ditemukan');
            $order_detail = $this->orderDetailService->find_one_by_order_id($order->id, $data->product_id);
            if ($order_detail) {
                $total_quantity = $order_detail->quantity + 1;
                $entity = [
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $order_detail->quantity + 1,

                    'total_price' => $product->price * $total_quantity

                ];

                $this->orderDetailService->update($entity);

                $order_detail_entity = $this->orderDetailService->find_by_id_search_with_order_created($order->id);
                $quantity = 0;
                foreach ($order_detail_entity as $ode) {
                    $quantity += $ode->quantity;
                }

                $order_entity = [
                    'id' => $order->id,
                    'order_number' => $order->order_number,
                    'user_id' => $user->id,
                    'status' => 'Order Created',
                    'quantity' => $quantity

                ];
                $this->orderRepository->update($order_entity);
            } else {
                $entity = [
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'notes' => "none",
                    'address' => "none",
                    'total_price' => $product->price * 1

                ];
                $this->orderDetailService->create($entity);
                $order_detail_entity = $this->orderDetailService->find_by_id_search_with_order_created($order->id);
                $quantity = 0;
                foreach ($order_detail_entity as $ode) {
                    $quantity += $ode->quantity;
                }
                $order_entity = [
                    'id' => $order->id,
                    'order_number' => $order->order_number,
                    'user_id' => $user->id,
                    'status' => 'Order Created',
                    'shipping' => null,
                    'quantity' => $quantity

                ];
                $this->orderRepository->update($order_entity);
            }
        }
    }

    public function total_cart_item($user)
    {

        $data = $this->orderRepository->find_one_with_user_and_status($user->id);
        $quantity = 0;
        foreach ($data as $ode) {
            $quantity += $ode->quantity;
        }
        return $quantity;
    }

    public function find_one_with_user_and_status($id)
    {
        return $this->orderRepository->find_one_with_user_and_status($id);
    }

    public function find_one_with_order_number($order_number, $user_id)
    {
        return $this->orderRepository->find_one_with_order_number($order_number, $user_id);
    }

    public function updateOrder($data)
    {
        return $this->orderRepository->update($data);
    }

    public function checkout($order_number, $user)
    {
        $order = $this->orderRepository->find_one_with_order_number($order_number, $user->id);
        $data = $this->orderRepository->find_one_with_order_detail_with_order_number($order->id, $user->id);

        if (!$data) {
            return redirect()->route('login')->with('error', 'tidak ada data');
        } else {

            return $data;
        }
    }

    public function check_cost($data)
    {
        $data = $this->rajaOngkirService->check_cost($data);
        $encode = json_decode($data);
        $name = $encode->rajaongkir->destination_details->city_name;
        $type = $encode->rajaongkir->destination_details->type;
        $check_kota = $this->locationService->get_city_from_name($type, $name);

        return json_decode($data);
    }
}
