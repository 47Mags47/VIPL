<?php

namespace App\Http\Requests\Glossary\Division;

use App\Models\Glossary\Division;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'min:3', 'max:5', 'unique:' . Division::class . ',code'],
            'name' => ['required', 'string', 'min:3', 'max:255', 'unique:' . Division::class . ',name']
        ];
    }
}
