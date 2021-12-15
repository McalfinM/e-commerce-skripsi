<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{


    public function create($data)
    {
        $product = new Product();
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->stock = $data['stock'];
        $product->image = $data['image'];
        $product->save();

        return $product;
    }

    public function update($data)
    {
        $product = Product::where('id', $data->id)->first();
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->stock = $data['stock'];
        $product->image = $data['image'];
        $product->update();

        return $product;
    }

    public function get_all($search)
    {
        if (!$search) {
            return Product::paginate(10);
        } else {
            return Product::query()
                ->where('name', 'LIKE', "%{$search}%")
                ->paginate(20);
        }
    }

    public function find_one($id)
    {
        $product = Product::where('id', $id)->first();
        return $product;
    }

    public function find_one_by_slug($slug)
    {
        return Product::where('slug', $slug)->first();
    }
}
