<?php

namespace App\Http\Resources\Glossary;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'number' => $this->number,
            'signed_at' => $this->number,
            'sides' => [
                'bank' => ContractSideResource::make($this->bank),
                'division' => ContractSideResource::make($this->division),
            ],
        ];
    }
}
