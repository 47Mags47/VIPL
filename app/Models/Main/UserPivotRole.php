<?php

namespace App\Models\Main;

use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $role_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\Main\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPivotRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPivotRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPivotRole query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPivotRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPivotRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPivotRole whereRoleCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPivotRole whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPivotRole whereUserId($value)
 * @mixin \Eloquent
 */
class UserPivotRole extends Model
{
    use HasLog, Named;

    ### Настройки
    ##################################################
    protected
        $table = 'main__user_pivot_role',
        $guarded = [];

    ### Связи
    ##################################################
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
