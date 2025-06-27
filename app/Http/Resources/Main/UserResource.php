<?php

namespace App\Http\Resources\Main;

use App\Http\Resources\Glossary\UserStatusResource;
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
            'status' => UserStatusResource::make($this->status),
            'online' => true,
            'division' => $this->division !== null ? $this->division->toResource() : null,
            'roles' => $this->roles->toResourceCollection(),
            'deleted' => $this->trashed()
        ];
    }
}
