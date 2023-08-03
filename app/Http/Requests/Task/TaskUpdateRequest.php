<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TaskUpdateRequest extends FormRequest
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
            'id' => ['required', 'number'],
            'title' => ['required', 'max:100'],
            'description' => ['required', 'max:255'],
            'date' => ['required', 'date_format:Y-m-d H:i:s'],
            'status' => ['required', Rule::in(['true', 'false'])],
            'name_category' => ['required', 'max:10'],
            'icon_category' => ['required', 'max:150'],
            'color_category' => ['required', 'max:150']
        ];
    }
}
