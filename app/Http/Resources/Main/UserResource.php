<?php

namespace App\Http\Resources\Main;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'status' => [
                'code' => 'avtorize',
                'name' => 'Авторизирован',
            ],
            'online' => true,
            'division' => $this->division !== null ? [
                'id' => $this->division->id,
                'name' => $this->division->name,
            ] : null,
            'roles' => $this->roles->toResourceCollection(),
        ];
    }
}
