<?php

namespace App\Http\Resources\Payment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'd_rojd' => $this->d_rojd->format('d.m.Y'),
            'snils' => $this->snils,
            'account' => $this->account,
            'summ' => number_format($this->summ, 2, '.', ' ') . ' RUB',
            'pasp' => $this->p_series . ' ' . $this->p_number . ' Выдан: ' . $this->p_date->format('d.m.Y') . ', ' . $this->p_div,
        ];
    }
}
