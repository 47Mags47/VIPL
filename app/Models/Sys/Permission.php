<?php

namespace App\Models\Sys;

use App\Models\Main\User;
use App\Models\Main\UserPivotPermission;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * 
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sys\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission users()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
