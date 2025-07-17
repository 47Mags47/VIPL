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
        // dd($this->rolePermissions()->map(fn($permission) => $permission->code));
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'status' => [
                'name' => $this->status->name,
                'color' => [
                    'new' => 'orange',
                    'send-invite' => 'orange',
                    'send-verify' => 'orange',
                    'active' => 'green',
                    'disabled' => 'red',

                ][$this->status->code],
            ],

            'online' => true,
            'division' => $this->division !== null ? $this->division->toResource() : null,
            'roles' => $this->roles->toResourceCollection(),
            'permissions' => $this->rolePermissions()->map(fn($permission) => $permission->code)->toArray(),
            'deleted' => $this->trashed()
        ];
    }
}
