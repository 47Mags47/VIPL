<?php

namespace App\Http\Resources\Payment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd(formatSizeUnits(Storage::disk($this->disk)->size($this->localPath())));
        return [
            'id' => $this->id,
            'name' => $this->origin_name,
            'status' => $this->status->name,
            'recipients' => $this->recipients()->count(),
            'summ' => $this->recipients->sum('summ'),

            'hash' => Storage::disk($this->disk)->checksum($this->localPath()),
            'size' => formatSizeUnits(Storage::disk($this->disk)->size($this->localPath())),
        ];
    }
}
