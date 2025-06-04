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
            'bank'                        => ['array:number_code,code,name,exporter_id'],
            'bank.number_code'            => ['required', 'string', 'min:3', 'max:3', 'unique:' . Bank::class . ',number_code,' . $this->route('bank')->id . ',number_code'],
            'bank.code'                   => ['required', 'string', 'min:3', 'max:10', 'unique:' . Bank::class . ',name,' . $this->route('bank')->id],
            'bank.name'                   => ['required', 'string', 'min:3', 'max:255'],
            'bank.exporter_id'            => ['required', 'exists:' . BankExporter::getTableName() . ',id'],

            'contract'                    => ['array:number,signed_at,division_side_id'],
            'contract.number'             => ['required', 'string', 'max:255'],
            'contract.signed_at'          => ['required', 'date'],
            'contract.division_side_id'   => ['required', 'exists:' . ContractSide::getTableName() . ',id'],

            'bank_side'                   => ['array:name,INN,account,BIK,comment'],
            'bank_side.name'              => ['required', 'string', 'max:255'],
            'bank_side.INN'               => ['required', 'string', 'min:10', 'max:10'],
            'bank_side.account'           => ['required', 'string', 'min:20', 'max:20'],
            'bank_side.BIK'               => ['required', 'string', 'min:9',  'max:9'],
            'bank_side.comment'           => ['nullable', 'string'],
        ];
    }
}
