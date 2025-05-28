<?php

namespace App\Http\Requests\Glossary\Bank;

use App\Models\Glossary\Bank;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return user()->hasPermission('glossary-bank-create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'number_code' => ['required', 'string', 'min:3', 'max:3', 'unique:' . Bank::getTableName() . ',number_code'],
            'code' => ['required', 'string', 'min:3', 'max:10', 'unique:' . Bank::getTableName() . ',code'],
            'name' => ['required', 'string', 'min:3', 'max:255', 'unique:' . Bank::getTableName() . ',name']
        ];
    }
}
