<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:8'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Este campo é obrigatório',
            'name.min' => 'Digite no mínimo 3 caracteres!',

            'email.required' => 'Este campo é obrigatório!',
            'email.email' => 'Email inválido!',
            'email.unique' => 'Email já cadastrado!',

            'password.required' => 'Este campo é obrigatório!',
            'password.min' => 'Digite no mínimo 8 caracteres!'
        ];
    }
}
