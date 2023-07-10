<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAppointmentRequest extends FormRequest
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
            'idAppointmentType' => 'required|numeric',
            'date' => 'required|date',
            'place'=> 'required|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'idAppointmentType' => 'Un Type de rendez-vous est requis',
            'date' => 'Une date & une heure sont requis',
            'place' => 'Un nombre de place est requis'
        ];
    }
}
