<?php

namespace App\Http\Requests\Glossary\Payment;

use App\Models\Glossary\Payment;
use App\Models\Glossary\Law;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'start_at' => now()
        ]);
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
                'unique:' . Payment::class . ',code'
            ],
            'name'  => [
                'required',
                'string',
                'unique:' . Payment::class . ',name'
            ],
            'krv'   => [
                'required',
                'string',
                'max:255',
                'unique:' . Payment::class . ',krv'
            ],
            'kbk'   => [
                'required',
                'string',
                'min:20',
                'max:20',
                'regex:/[0-9]{3}[0-9]{4}[0-9]{5}[0-9]{5}[0-9]{3}/',
                'unique:' . Payment::class . ',kbk'
            ],
            'law_id' => [
                'required',
                'exists:' . Law::class . ',id'
            ],
        ];
    }
}
