<?php

namespace App\Models\Sys;

use App\Models\Main\User;
use App\Models\Main\UserPivotRole;
use App\Traits\hasApi;
use App\Traits\hasCode;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Builder;
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sys\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static Builder<static>|Role api()
 * @method static Builder<static>|Role byCode(string $code)
 * @method static Builder<static>|Role createAccess()
 * @method static Builder<static>|Role newModelQuery()
 * @method static Builder<static>|Role newQuery()
 * @method static Builder<static>|Role notRoot()
 * @method static Builder<static>|Role query()
 * @method static Builder<static>|Role whereCode($value)
 * @method static Builder<static>|Role whereCreatedAt($value)
 * @method static Builder<static>|Role whereId($value)
 * @method static Builder<static>|Role whereName($value)
 * @method static Builder<static>|Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends Model
{
    use hasApi, hasCode, HasLog, Named;

    ### Настройки
    ##################################################
    protected
        $table = 'sys__roles';

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
