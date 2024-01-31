<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomersPasswordUpdateRequest extends FormRequest
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
            'password' => 'required|min:12|max:255',
            'password_confirm' => 'required|min:12|max:255'
        ];
    }

    public function messages()
    {
        return [
            'password' => 'Une mot de passe est requis, minimum 12 caractères',
            'password_confirm' => 'Une mot de passe de confirmation est requis, minimum 12 caractères'
        ];
    }
}
