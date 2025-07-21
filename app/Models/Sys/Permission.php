<?php

namespace App\Models\Sys;

use App\Models\Main\User;
use App\Models\Main\UserPivotPermission;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasLog, Named;

    ### Настройки
    ##################################################
    protected
        $table = 'sys__permissions';

    ### Функции
    ##################################################
    /**
     * @return BelongsToMany Пользователи, обладающие этим правом
     */
    public function scopeUsers()
    {
        $permission_users = $this->belongsToMany(User::class, UserPivotPermission::getTableName(), 'permission_code')->get();
        $role_users = $this->roles->map(function ($role) {
            return $role->users;
        })->collapse();

        return $permission_users->merge($role_users);
    }

    ### Связи
    ##################################################
    /**
     * @return BelongsToMany Роли, обладающие этим правом
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, RolePivotPermission::getTableName(), 'permission_code', 'role_code', 'code', 'code');
    }
}
