<?php

namespace App\Http\Resources\Payment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RaportResource extends JsonResource
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
            'name' => $this->original_name,
            'status' => $this->status->toResource(),
            'start_by' => $this->startBy->toResource(),
            'created_at' => $this->created_at->format('Y-m-d H:i'),
        ];
    }
}
