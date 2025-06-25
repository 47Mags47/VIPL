<?php

namespace App\Http\Requests\Main\User;

use App\Models\Glossary\Division;
use App\Models\Main\Role;
use App\Models\Main\User;
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
            'division_id' => ['required', 'exists:' . Division::class . ',id'],
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'unique:' . User::class . ',email,' . $this->route('user')->id],
            'roles' => ['array', 'min:1'],
            'roles.*' => ['exists:' . Role::class . ',code'],
        ];
    }
}
