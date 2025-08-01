<?php

namespace App\Http\Requests\Glossary\Payment;

use App\Models\Glossary\Payment;
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
            'kbk'   => [
                'required',
                'string',
                'min:20',
                'max:20',
                'regex:/[0-9A-ZА-Я]{20}/'
            ],
        ];
    }
}
