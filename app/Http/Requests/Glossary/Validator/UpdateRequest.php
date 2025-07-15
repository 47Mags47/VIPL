<?php

namespace App\Http\Requests\Glossary\Validator;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file_pos' => ['required', 'integer'],
            'required' => ['required', 'boolean'],
            'patterns' => ['required', 'array'],
            'patterns.*' => ['required', 'string', 'min:2', 'max:255']
        ];
    }
}
