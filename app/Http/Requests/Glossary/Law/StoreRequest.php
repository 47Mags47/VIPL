<?php

namespace App\Http\Requests\Glossary\Law;

use App\Models\Glossary\Law;
use App\Models\Glossary\Source;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'unique:' . Law::getTableName() . ',code'
            ],
            'name' => [
                'required',
                'string',
            ],
            'source_id' => [
                'required',
                'exists:' . Source::getTableName() . ',id'
            ]
        ];
    }
}
