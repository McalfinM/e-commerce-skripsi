<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Cocur\Slugify\Slugify;
use Illuminate\Support\Str;

class ProductService
{

    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function create($data)
    {
        // dd($data);
        $tor_name = "";
        if ($data['image'] !== null) {
            $tor = $data['image'];
            $tor_name = Str::random(20) . '.' . $tor->extension();
            $tor->store('image/public/product', $tor_name);
        } else {
            $tor_name = "image.jpg";
        }

        $data['image'] = $tor_name;
        $product = $this->productRepository->create($data);
        return $product;
    }

    public function get_all($search)
    {
        $product = $this->productRepository->get_all($search);
        return $product;
    }

    public function find_one($id)
    {
        $product = $this->productRepository->find_one($id);
        return $product;
    }

    public function find_one_by_slug($slug)
    {
        return $this->productRepository->find_one_by_slug($slug);
    }
}
