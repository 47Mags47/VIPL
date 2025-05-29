<?php

namespace App\Http\Requests\Glossary\Law;

use App\Models\Glossary\PaymentLaw;
use App\Models\Glossary\PaymentSource;
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
                'unique:' . PaymentLaw::getTableName() . ',code'
            ],
            'name' => [
                'required',
                'string',
            ],
            'source_id' => [
                'required',
                'exists:' . PaymentSource::getTableName() . ',id'
            ]
        ];
    }
}
