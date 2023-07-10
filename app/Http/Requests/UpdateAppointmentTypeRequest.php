<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentTypeRequest extends FormRequest
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
            'id' => 'required|numeric',
            'name' => 'required|max:50',
            'description' => 'required|max:255',
            'location' => 'required|max:50',
            'street' => 'required|max:50',
            'streetNumber' => 'required|max:50|numeric',
            'zipCode' => 'required|max:5|min:3',
            'active' => 'required|bool'
        ];
    }

    public function messages(): array
    {
        return [
            'name' => 'Un nom est requis, maximum 50 caractères',
            'description' => 'Une description est requise, maximum 255 caractères',
            'location' => 'Une ville est requise, maximum 50 caractères',
            'street' => 'Une rue est requise, maximum 50 caractères',
            'streetNumber' => 'Un numéro de rue est requis, maximum 50 caractères, au format numérique',
            'zipCode' => 'Un code postal est requis, maximum 5 caractères au format numérique',
            'active' => 'Le status d\'activation est requis'
        ];
    }
}
