<?php

namespace App\Http\Requests\Configurate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return isLocalRequest($this) and user()->hasPermission('system_configuration');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $origin = $this->route('config');

        switch ($origin->type) {
            case 'string':
                return [
                    'value' => ['required', 'string', 'min:1', 'max:255'],
                ];
                break;

            case 'text':
                return [
                    'value' => ['required', 'string', 'min:1'],
                ];
                break;

            case 'int':
                return [
                    'value' => ['required', 'integer'],
                ];
                break;
        }

        return [];
    }
}
