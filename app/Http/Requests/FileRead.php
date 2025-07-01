<?php

namespace App\Http\Requests;

use App\Models\Glossary\Bank;
use App\Models\Glossary\Division;
use Illuminate\Foundation\Http\FormRequest;

class FileRead extends FormRequest
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
            'path' => ['required', 'string'],
            'bank_id' => ['required', 'exists:'. Bank::class .',id'],
            'payment_id' => ['required', 'exists:'. Division::class .',id'],
        ];
    }
}
