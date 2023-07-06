<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CreateLoginRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', Password::min(8)],
            'confirmPassword' => ['required', 'same:password', Password::min(8)]
        ];
    }

    public function messages(): array 
    {
        return [
            'name.required' => 'O campo de nome é obrigatório',
            'name.max' => 'Foi excedido o limite de caracteres no nome',
            'email.required' => 'O campo de email é obrigatório',
            'email.max' => 'Foi excedido o limite de caracteres no email',
            'password.min' => 'O campo de senha deve ter pelo meno 8 caracteres',
            'confirmPassword.min' => 'O campo de senha deve ter pelo meno 8 caracteres',
            'confirmPassword.same' => 'A senha de confirmação deve ser igual'
        ];
    }
}
