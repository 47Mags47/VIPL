<?php

namespace App\Http\Resources\Glossary;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'code' => $this->code,
            'krv' => $this->krv,
            'kbk' => $this->kbk,
            'name' => $this->name,
            'start_at' => $this->start_at->format('Y-m-d'),
            'law' => LawResource::make($this->law),
            'periodicity' => PaymentPeriodicityResource::make($this->periodicity),
        ];
    }
}
