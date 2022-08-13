<?php
namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'title' => 'required|unique:recipes,title|max:150',
            'category_uuid' => 'required',
            'gallery_directory' => [
                'nullable',
                'image',
                'max:1024',
            ],
            'preparation_time' => 'required|max:150',
            'difficulty' => 'required|numeric',
            'number_of_people_served' => 'required|numeric',
            'ingredients' => 'required',
            'preparation_mode' => 'required',
            'is_active' => 'required|boolean'

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Este campo é obrigatório!',
            'title.unique' => 'Essa receita já existe!',
            'title.max' => 'Limite de 150 caracteres atingido!',

            'category_uuid.required' => 'Este campo é obrigatório!',

            'gallery_directory.image' => 'É permitido somente imagens!',
            'gallery_directory.max' => 'Limite de 1M de tamanho atingido!',

            'preparation_time.required' => 'Este campo é obrigatório!',
            'preparation_time.max' => 'Limite de 15 0 caracteres atingido!',

            'difficulty.required' => 'Este campo é obrigatório!',
            'difficulty.numeric' => 'Dificuldade inválida!',

            'number_of_people_served.required' => 'Este campo é obrigatório!',
            'number_of_people_served.numeric' => 'Este campo aceita apenas números!',

            'ingredients.required' => 'Este campo é obrigatório!',

            'preparation_mode.required' => 'Este campo é obrigatório',

            'is_active.required' => 'Este campo é obrigatório',
            'is_active.boolean' => 'Valor inválido!'

        ];
    }
}
