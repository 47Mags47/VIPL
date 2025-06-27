<?php

namespace App\Http\Requests\Configurate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'division' => ['required', 'array'],
            'divsion.name'      => ['nullable', 'string', 'min:3', 'max:255'],
            'division.INN'      => ['nullable', 'string', 'min:10', 'max:10'],
            'division.account'  => ['nullable', 'string', 'min:20', 'max:20'],
            'division.BIK'      => ['nullable', 'string', 'min:9',  'max:9'],
        ];
    }
}
