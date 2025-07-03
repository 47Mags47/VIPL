<?php

namespace App\Http\Requests\Glossary\Payment;

use App\Models\Glossary\Payment;
use App\Models\Glossary\Law;
use App\Models\Glossary\PaymentPeriodicity;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return user()->hasPermission('edit_glossary');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code'  => [
                'required',
                'string',
                'min:3',
                'max:10',
                'unique:' . Payment::class . ',code,' . $this->route('payment')->id
            ],
            'name'  => [
                'required',
                'string',
                'unique:' . Payment::class . ',name,' . $this->route('payment')->id
            ],
            'krv'   => [
                'required',
                'string',
                'max:255',
                'unique:' . Payment::class . ',krv,' . $this->route('payment')->id
            ],
            'kbk'   => [
                'required',
                'string',
                'min:20',
                'max:20',
                'regex:/[0-9]{3}[0-9]{4}[0-9]{5}[0-9]{5}[0-9]{3}/',
                'unique:' . Payment::class . ',kbk,' . $this->route('payment')->id
            ],
            'law_id'   => [
                'required',
                'exists:' . Law::class . ',id'
            ],
            'periodicity_id' => [
                'required',
                'exists:' . PaymentPeriodicity::class . ',id'
            ],
        ];
    }
}
