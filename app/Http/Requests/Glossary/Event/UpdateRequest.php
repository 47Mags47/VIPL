<?php

namespace App\Http\Requests\Glossary\Event;

use App\Models\Glossary\Payment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'date' => ['date', 'after:now'],
            'payment_id' => ['required', 'exists:' . Payment::class . ',id']
        ];
    }
}
