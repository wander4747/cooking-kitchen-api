<?php
namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:150|unique:categories',
            'gallery_directory' => 'nullable|max:1024',
            'is_active' => 'required|boolean',
            'in_home' => 'required|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Este campo é obrigatório.',
            'title.max' => 'Este campo permite no máximo 150 caracteres.',
            'title.unique' => 'Esta categoria já existe.',

            'gallery.required' => 'Este campo é obrigatório.',
            'gallery.max' => 'Este campo permite no máximo 200 caracteres.',

            'is_active.required' => 'Este campo é obrigatório.',
            'is_active.boolean' => 'Valor inválido.',

            'in_home.required' => 'Este campo é obrigatório.',
            'in_home.boolean' => 'Valor inválido.'
        ];
    }
}
