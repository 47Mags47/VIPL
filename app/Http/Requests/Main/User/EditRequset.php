<?php

namespace App\Http\Requests\Main\User;

use Illuminate\Foundation\Http\FormRequest;

class EditRequset extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->route('user')->roles->pluck('code')->contains('root'))
            return false;

        if ($this->route('user')->id === user()->id)
            return false;

        if (!user()->hasPermission('create_system_admins') and $this->division_id != user()->division->id)
            return false;

        return true;
    }
}
