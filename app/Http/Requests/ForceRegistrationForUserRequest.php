<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForceRegistrationForUserRequest extends FormRequest
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
            'idAppointment' => 'required|numeric',
            'idUser' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'idAppointment' => 'Un rendez-vous est requis',
            'idUser' => 'Un utilisateur est requis'
        ];
    }
}
