<?php
namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class TipRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:150|unique:tips',
            'gallery_directory' => 'nullable|image|max:1024',
            'category_uuid' => 'required',
            'tip' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Este campo é obrigatório!',
            'title.max' => 'Limite de 150 caracteres atingido!',
            'title.unique' => 'Esta dica já existe!',

            'gallery_directory.image' => 'É permitido somente imagens!',
            'gallery_directory.max' => 'Limite de 1M de tamanho atingido!',

            'category_uuid.required' => 'Este campo é obrigatório!',

            'tip.required' => 'Este campo é obrigatório!'
        ];
    }
}
