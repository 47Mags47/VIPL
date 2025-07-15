<?php

namespace App\Models\Main;

use App\Traits\hasApi;
use App\Traits\hasCode;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use Named, HasLog, hasCode, hasApi;

    ### Настройки
    ##################################################
    protected
        $table = 'main__roles';

    ### Ограничения
    ##################################################
    public function scopeNotRoot(): Builder
    {
        return $this->whereNot('code', 'root');
    }

    public function scopeCreateAccess(): Builder
    {
        return $this->where(function ($query) {
            $query->where('code', 'user');

            if (user()->hasPermission('create_system_admins'))
                $query->orWhere('code', 'system_admin');

            if (user()->hasPermission('create_division_admins'))
                $query->orWhere('code', 'division_admin');
        });;
    }

    ### Связи
    ##################################################
    /**
     * @return BelongsToMany Права, обладающие этой ролью
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, RolePivotPermission::getTableName(), 'role_code', 'permission_code', 'code', 'code');
    }

    /**
     * @return BelongsToMany Пользователи, обладающие этой ролью
     */
    public function users()
    {
        return $this->belongsToMany(User::class, UserPivotRole::getTableName(), 'role_code', 'user_id', 'code');
    }
}
