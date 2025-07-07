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
        return [
            'id' => $this->id,
            'name' => $this->origin_name,
            'status' => [
                'name' => $this->status->name,
                'color' => [
                    'uploaded' => 'orange',
                    'reading' => 'orange',
                    'read' => 'orange',
                    'loading' => 'orange',
                    'load' => 'green',
                    'has-errors' => 'red',
                ][$this->status->code],
            ],
            'recipients' => $this->recipients()->count(),
            'summ' => number_format($this->getTotalSumm(), 2, '.', ' ') . ' RUB',
            'hash' => Storage::disk($this->disk)->checksum($this->localPath()),
            'size' => formatSizeUnits(Storage::disk($this->disk)->size($this->localPath())),
            'bank' => $this->bank->toResource(),
            'errors'=> [
                'list' => $this->errors ?? [],
                'context' => $this->error_context ?? []
            ],
        ];
    }
}
