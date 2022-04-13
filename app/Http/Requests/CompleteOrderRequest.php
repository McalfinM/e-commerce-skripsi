<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompleteOrderRequest extends FormRequest
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
            'address' => 'required',
            'pic_name' => 'required',
            'surat_jalan' => 'required|file|mimes:pdf,docx'
        ];
    }

    public function messages()
    {
        return [
            'address.required' => 'alamat tidak boleh kosong',
            'pic_name.required' => 'nama penanggung jawab tidak boleh kosong',
            'surat_jalan.required' => 'surat jalan tidak boleh kosong'
        ];
    }
}
