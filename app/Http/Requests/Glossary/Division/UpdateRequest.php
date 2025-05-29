<?php

namespace App\Http\Requests\Glossary\Division;

use App\Models\Glossary\Division;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return user()->hasPermission('glossary-division-update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'min:3', 'max:5', 'unique:' . Division::getTableName() . ',code,' . $this->code],
            'name' => ['required', 'string', 'min:3', 'max:255', 'unique:' . Division::getTableName() . ',name,' . $this->name]
        ];
    }
}
