<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','max:255'],
            'email' => ['email', 'max:255'],
            'password' => ['required', 'max:100']
        ];
    }

    public function messages(): array 
    {
        return [
            'name.required' => 'O campo de nome é obrigatório',
            'password.required' => 'O campo de senha é obrigatório'
        ];
    }
}
