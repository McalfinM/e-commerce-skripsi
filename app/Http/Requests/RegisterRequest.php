<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'required|string|max:10|unique:users',
            'password' => 'required|string|max:15',
            'confirm_password' => 'required|string|max:15|same:password',
            'email' => 'required|string|unique:users'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username harus ada',
            'password.required' => 'Password harus ada',
            'email.required' => 'Email harus ada',
            'confirm_password.required' => 'konfirmasi password tidak boleh kosong',
        ];
    }
}
