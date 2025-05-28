<?php

namespace App\Http\Resources\Glossary;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BankResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'number_code' => $this->number_code,
            'code' => $this->code,
            'name' => $this->name,
            'contract' => BankContractResource::make($this->contract),
            'exporter' => BankExporterResource::make($this->exporter),
        ];
    }
}
