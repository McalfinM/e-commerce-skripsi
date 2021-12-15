<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'payment_method' => 'required',
            "phone_number" => 'required',
            'ppn' => 'nullable',
            'address' => 'required',
            'province' => 'required',
            'city' => 'required',
            'district' => 'required',
            'village' => 'required',
            'postal_code' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Masukan nama anda',
            'payment_method.required' => "Pilih Metode pembayaran",
            "phone_number.required" => "Nomor handphone tidak boleh kosong",
            "address.required" => "Alamat tidak boleh kosong",
            "province.required" => "Provinsi tidak boleh kosong",
            "city.required" => "Kota tidak boleh kosong",
            "district.required" => "Kecamatan tidak boleh kosong",
            "village.required" => "Kelurahan tidak boleh kosong",
            "postal_code.required" => "Kode pos tidak boleh kosong"
        ];
    }
}
