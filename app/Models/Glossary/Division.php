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
 * 
 *
 * @var string $table glossary__divisions
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static Builder<static>|Division api()
 * @method static Builder<static>|Division byCode(string $code)
 * @method static Builder<static>|Division createAccess()
 * @method static Builder<static>|Division filter(\App\Classes\Filter $filter)
 * @method static Builder<static>|Division newModelQuery()
 * @method static Builder<static>|Division newQuery()
 * @method static Builder<static>|Division notRoot()
 * @method static Builder<static>|Division onlyTrashed()
 * @method static Builder<static>|Division query()
 * @method static Builder<static>|Division whereCode($value)
 * @method static Builder<static>|Division whereCreatedAt($value)
 * @method static Builder<static>|Division whereDeletedAt($value)
 * @method static Builder<static>|Division whereId($value)
 * @method static Builder<static>|Division whereName($value)
 * @method static Builder<static>|Division whereUpdatedAt($value)
 * @method static Builder<static>|Division withTrashed()
 * @method static Builder<static>|Division withoutTrashed()
 * @mixin \Eloquent
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
