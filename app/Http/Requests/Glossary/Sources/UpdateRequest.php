<?php

namespace App\Http\Requests\Glossary\Sources;

use App\Models\Glossary\Source;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'min:2', 'max:255', 'unique:' . Source::class . ',code,' . $this->route('source')->id],
            'name' => ['required', 'string', 'min:2', 'max:255', 'unique:' . Source::class . ',name,' . $this->route('source')->id],
        ];
    }
}
