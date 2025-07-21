<?php

namespace App\Http\Resources\Main\Payment;

use App\Http\Resources\Glossary\DivisionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'status' => [
                'name' => $this->status->name,
                'color' => [
                    'created' => 'red',
                    'updated' => 'orange',
                    'ready' => 'green'
                ][$this->status->code],
            ],
            'created_at' => $this->created_at->format('Y-m-d'),
            'division' => DivisionResource::make($this->division),
            'event' => $this->event->toResource(),

            'totalSumm' => number_format($this->getTotalSumm(), 2, '.', ' ') . ' RUB',
        ];
    }
}
