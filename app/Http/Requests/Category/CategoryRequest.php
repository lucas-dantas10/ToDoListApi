<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:10'],
        ];
    }

    public function messages(): array 
    {
        return [
            'name.required' => 'O campo de nome é obrigatório',
            'name.max' => 'O máximo de caracteres permitido é 10',
            'icon.required' => 'Obrigatório selecionar um ícone',
            'color.required' => 'Obrigatório selecionar uma cor'
        ];
    }
}
