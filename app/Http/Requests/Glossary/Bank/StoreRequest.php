<?php

namespace App\Http\Requests\Glossary\Bank;

use App\Models\Glossary\Bank;
use App\Models\Glossary\BankExporter;
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
            'bank.number_code'            => ['required', 'string', 'min:3', 'max:3', 'unique:' . Bank::class . ',number_code'],
            'bank.code'                   => ['required', 'string', 'min:3', 'max:10', 'unique:' . Bank::class . ',name'],
            'bank.name'                   => ['required', 'string', 'min:3', 'max:255'],
            'bank.exporter_id'            => ['required', 'exists:' . BankExporter::getTableName() . ',id'],

            'contract.number'             => ['nullable', 'string', 'max:255'],
            'contract.signed_at'          => ['nullable', 'date'],
        ];
    }
}
