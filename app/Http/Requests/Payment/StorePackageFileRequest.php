<?php

namespace App\Http\Requests\Payment;

use App\Models\Glossary\Bank;
use App\Models\Payment\Package;
use Illuminate\Foundation\Http\FormRequest;

class StorePackageFileRequest extends FormRequest
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
            'bank_id' => ['required', 'exists:'. Bank::getTableName() .',id'],
            'path' => ['required', 'string', 'max:255'],
            'package_id' => ['required', 'exists:'. Package::getTableName() .',id']
        ];
    }
}
