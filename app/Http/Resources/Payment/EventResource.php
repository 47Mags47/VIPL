<?php

namespace App\Http\Resources\Payment;

use App\Http\Resources\Glossary\PaymentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date->format('Y-m-d'),
            'payment' => [
                'code' => $this->payment->code,
                'krv' => $this->payment->krv,
            ],
        ];
    }
}
