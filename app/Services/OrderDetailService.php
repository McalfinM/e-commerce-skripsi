<?php

namespace App\Services;

use App\Repositories\OrderDetailRepository;

class OrderDetailService
{

    protected $orderDetailRepository;

    public function __construct(OrderDetailRepository $orderDetailRepository)
    {
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function create($data)
    {
        $data = $this->orderDetailRepository->create($data);
    }

    public function update($data)
    {
        $data = $this->orderDetailRepository->update($data);
    }

    public function find_one_by_order_id($id, $product_uuid)
    {
        $data = $this->orderDetailRepository->find_one_by_order_id_and_product_uuid($id, $product_uuid);
        return $data;
    }

    public function find_by_id_search_with_order_created($id)
    {
        $data = $this->orderDetailRepository->find_by_id_search_with_order_created($id);
        return $data;
    }
}
