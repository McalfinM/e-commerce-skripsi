<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'image|file|mimes:jpg,png,jpeg|nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'price.required' => 'Harga Produk tidak boleh kosong',
            'stock.required' => 'Stok barang tidak boleh kosong',
            // 'image' => 'Image harus berupa gambar'
        ];
    }
}
