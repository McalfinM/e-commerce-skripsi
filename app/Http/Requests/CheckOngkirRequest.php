<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckOngkirRequest extends FormRequest
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
            'origin' => 'required|string',
            'weight' => 'required|string',
            'destination' => 'required|string',
            'courier' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'origin.required' => 'Asal kamu tidka boleh kosong',
            'destination.required' => 'Tujuan kamu tidak boleh kosong',
            'weight.required' => 'Berat barang tidak boleh kosong',
            'courier.required' => 'Pilih kurir pengiriman terlebih dahulu'
        ];
    }
}
