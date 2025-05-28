<?php

namespace App\Models\Main;

use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use Named, HasLog;

    ### Настройки
    ##################################################
    protected
        $table = 'main__roles';

    ### Связи
    ##################################################
    /**
     * @return BelongsToMany Права, обладающие этой ролью
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, RolePivotPermission::getTableName());
    }

    /**
     * @return BelongsToMany Пользователи, обладающие этой ролью
     */
    public function users()
    {
        return $this->belongsToMany(User::class, UserPivotRole::getTableName(), 'role_code');
    }
}
