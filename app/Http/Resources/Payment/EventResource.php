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
        // if($this->payment == null)
        //     dd();
        return [
            'id' => $this->id,
            'date' => $this->date->format('Y-m-d'),
            'name' => $this->payment()->withTrashed()->first()->code . ' - ' . $this->payment()->withTrashed()->first()->krv
            // 'payment' => [
            //     'code' => $this->payment->code,
            //     'krv' => $this->payment->krv,
            // ],
        ];
    }
}
