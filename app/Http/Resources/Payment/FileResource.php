<?php

namespace App\Http\Resources\Payment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
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
            'name' => basename($this->path),
            'status' => $this->status->name,
            'recipients' => $this->recipients()->count(),
            'summ' => $this->recipients->sum('summ'),
            'hash' => $this->hash,
            'size' => formatSizeUnits($this->size),
        ];
    }
}
