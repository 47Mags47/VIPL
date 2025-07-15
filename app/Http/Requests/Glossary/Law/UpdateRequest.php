<?php

namespace App\Http\Requests\Glossary\Law;

use App\Models\Glossary\Law;
use App\Models\Glossary\Source;
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
            'code' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'unique:' . Law::class . ',code,' . $this->route('law')->id,
            ],
            'name' => [
                'required',
                'string',
            ],
            'source_id' => [
                'required',
                'exists:' . Source::class . ',id'
            ]
        ];
    }
}
