<?php

namespace App\Http\Resources\Main\Raports\Payment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TotalResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->original_name,
            'status' => [
                'name' => $this->status->name,
                'type' => $this->status->type,
            ],
            'start_by' => $this->startBy->toResource(),
            'created_at' => $this->created_at->format('Y-m-d H:i'),
        ];
    }
}
