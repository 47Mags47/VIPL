<?php

namespace App\Http\Requests\Glossary\Payment;

use App\Models\Glossary\Payment;
use App\Models\Glossary\Law;
use App\Models\Glossary\PaymentPeriodicity;
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
     * @return array<string ,\Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code'  => [
                'required',
                'string',
                'min:3',
                'max:10',
                'unique:' . Payment::getTableName() . ',code'
            ],
            'name'  => [
                'required',
                'string',
                'unique:' . Payment::getTableName() . ',name'
            ],
            'krv'   => [
                'required',
                'string',
                'max:255',
                'unique:' . Payment::getTableName() . ',krv'
            ],
            'kbk'   => [
                'required',
                'string',
                'min:24',
                'max:24',
                'regex:[0-9]{3} [0-9]{4} [0-9]{5} [0-9]{5} [0-9]{3}',
                'unique:' . Payment::getTableName() . ',kbk'
            ],
            'law_id' => [
                'required',
                'exists:' . Law::getTableName() . ',id'
            ],
            'periodicity_id' => [
                'required',
                'exists:' . PaymentPeriodicity::getTableName() . ',id'
            ],
        ];
    }
}
