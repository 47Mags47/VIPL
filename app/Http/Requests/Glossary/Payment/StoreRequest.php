<?php

namespace App\Http\Requests\Glossary\Payment;

use App\Models\Glossary\Payment;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return user()->hasPermission('glossary-payment-create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'min:3', 'max:10', 'unique:' . Payment::getTableName() . ',code'],
            'name' => ['required', 'string', 'min:3', 'max:255', 'unique:' . Payment::getTableName() . ',name']
        ];
    }
}
