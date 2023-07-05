<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlockingRequest extends FormRequest
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
            'user' => 'numeric|required',
            'block' => 'numeric|min:0|max:1|required'
        ];
    }

    public function messages()
    {
        return [
            'user' => 'Un utilisateur est requis',
            'block' => 'Le type de blocage n\'est pas valide'
        ];
    }
}
