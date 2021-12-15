<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function create()
    {
        return view('admin.product.create');
    }
    public function create_process(ProductRequest $request)
    {
        if (!$request->file()) {
            $request['image'] = null;
        }
        $this->productService->create($request->all());
        return redirect()->back()->with('success', 'Produk berhasil terbuat');
    }

    public function get_all(Request $request)
    {
        $data = $this->productService->get_all($request->query());
        return view('user.home', compact('data'));
    }
}
