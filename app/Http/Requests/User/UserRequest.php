<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
            'name' => ['max:100', 'string'],
            'password' => [Password::min(8)]
        ];
    }

    public function messages() {
        return [
            'name.string' => 'O campo de nome não pode estar vazio',
            'name.max' => 'O campo de nome deve conter até 100 caracteres',
            'password.string' => 'O campo de senha não pode estar vazio',
            'password.min' => 'O campo de senha deve conter pelo menos 8 caracteres'
        ];
    }
}
