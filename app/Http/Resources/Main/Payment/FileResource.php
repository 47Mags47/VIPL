<?php

namespace App\Http\Resources\Main\Payment;

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
            'name' => $this->origin_name,
            'status' => [
                'name' => $this->status->name,
                'type' => $this->status->type,
            ],
            'recipients' => $this->recipients()->count(),
            'summ' => number_format($this->getTotalSumm(), 2, '.', ' ') . ' RUB',
            'hash' => $this->getHash(),
            'size' => $this->getSize(),
            'bank' => $this->bank->toResource(),
            'errors' => [
                'list' => $this->errors ?? [],
                'context' => $this->error_context ?? []
            ],
        ];
    }
}
