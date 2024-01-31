<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'name' => 'required|max:50',
            'surname' => 'required|max:50',
            'email' => 'required|email|max:100',
            'phone' => 'required|max:10|min:10',
            'password' => 'required|min:12'
        ];
    }

    public function messages()
    {
        return [
            'name' => 'Un nom de famille est requis ne dépassant pas 50 caractères',
            'surname' => 'Un prénom est requis ne dépassant pas 50 caractères',
            'email' => 'Un email est requis ne dépassant pas 100 caractères',
            'phone' => 'Un téléphone est requis ne dépassant pas 10 caractères',
            'password' => 'Un mot de passe est requis, minimum 12 caractères',
        ];
    }
}
