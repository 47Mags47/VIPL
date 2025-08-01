<?php

namespace App\Models\Main;

use App\Models\Sys\Permission;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $permission_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Permission $permission
 * @property-read \App\Models\Main\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPivotPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPivotPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPivotPermission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPivotPermission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPivotPermission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPivotPermission wherePermissionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPivotPermission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPivotPermission whereUserId($value)
 * @mixin \Eloquent
 */
class UserPivotPermission extends Model
{
    use HasLog, Named;

    ### Настройки
    ##################################################
    protected
        $table = 'main__user_pivot_permission',
        $guarded = [];

    ### Связи
    ##################################################
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function permission():BelongsTo
    {
        return $this->belongsTo(Permission::class, 'permission_code', 'code');
    }
}
