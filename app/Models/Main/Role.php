<?php

namespace App\Models\Main;

use App\Traits\hasCode;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use Named, HasLog, hasCode;

    ### Настройки
    ##################################################
    protected
        $table = 'main__roles';

    protected static function booted(): void
    {
        static::addGlobalScope('not root', function (Builder $builder) {
            $builder->whereNot('code', 'root');
        });
    }

    ### функции
    ##################################################
    public static function roots(){
        return self::withoutGlobalScope('not root')->where('code', 'root')->first();
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
