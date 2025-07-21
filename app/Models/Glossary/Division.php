<?php

namespace App\Models\Glossary;

use App\Models\Main\User;
use App\Traits\hasApi;
use App\Traits\hasCode;
use App\Traits\HasFilter;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @var string $table glossary__divisions
 *
 * @method Builder notRoot() Исключает root из выборки
 * @method Builder createAccess() Исключает подразделения, для создания пользователей в которых у текущего пользователя нет прав
 *
 * @property \lluminate\Support\Collection $users [App\Models\Main\User] (пользователей) в подразделении
 */
class Division extends Model
{
    use hasApi, hasCode, HasFilter, HasLog, Named, SoftDeletes;

    ### Настройки
    ##################################################
    protected $table = 'glossary__divisions';

    protected $fillable = ['code', 'name'];

    ### Ограничения
    ##################################################
    public function scopeNotRoot(Builder $builder): Builder
    {
        return $builder->whereNot('code', 'root');
    }

    public function scopeCreateAccess(Builder $builder): Builder
    {
        return $builder->where(function ($query) {
            if (!user()->hasPermission('create_system_admins'))
                $query->where('id', user()->division->id);
        });
    }

    ### Связи
    ##################################################
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'division_id');
    }
}
