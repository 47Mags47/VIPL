<?php

namespace App\Http\Requests\Payment;

use App\Models\Glossary\Bank;
use Illuminate\Foundation\Http\FormRequest;

class CheckFileRequest extends FormRequest
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
            'bank' => ['required', 'exists:' . Bank::class . ',id'],
        ];
    }
}
