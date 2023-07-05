<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRankRequest extends FormRequest
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
            'user' => 'required|numeric',
            'rank' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'user' => 'Un utilisateur est requis',
            'rank' => 'Le rang ne semble pas être valide'
        ];
    }
}
