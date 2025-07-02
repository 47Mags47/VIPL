<?php

namespace App\Http\Requests\Glossary\Bank;

use App\Models\Glossary\Bank;
use App\Models\Glossary\BankExporter;
use App\Models\Glossary\ContractSide;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'bank.number_code'            => ['required', 'string', 'min:3', 'max:3', 'unique:' . Bank::class . ',number_code,' . $this->route('bank')->id],
            'bank.code'                   => ['required', 'string', 'min:3', 'max:10', 'unique:' . Bank::class . ',name,' . $this->route('bank')->id],
            'bank.name'                   => ['required', 'string', 'min:3', 'max:255'],
            'bank.exporter_id'            => ['required', 'exists:' . BankExporter::getTableName() . ',id'],

            'contract.number'             => ['required', 'string', 'max:255'],
            'contract.signed_at'          => ['required', 'date'],
        ];
    }
}
