<?php

namespace App\Http\Resources\Glossary;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BankExporterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $exporter_string = "App\\Exporters\\" . ucfirst($this->code) . 'BankExporter';

        return [
            'name' => $this->name,
            'valid' => class_exists($exporter_string),
        ];
    }
}
