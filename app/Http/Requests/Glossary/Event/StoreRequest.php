<?php

namespace App\Http\Requests\Glossary\Event;

use App\Models\Glossary\Payment;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'date' => ['required', 'array', 'min:1'],
            'date.*' => ['date', 'after:now'],
            'payment_id' => ['required', 'exists:' . Payment::class . ',id']
        ];
    }
}
