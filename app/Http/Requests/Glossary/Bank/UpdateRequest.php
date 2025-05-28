<?php

namespace App\Http\Requests\Glossary\Bank;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return user()->hasPermission('glossary-bank-update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'number_code' => ['required', 'string', 'min:3', 'max:3'],
            'code' => ['required', 'string', 'min:3', 'max:10'],
            'name' => ['required', 'string', 'min:3', 'max:255']
        ];
    }
}
