<?php

namespace App\Models\Sys;

use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $role_code
 * @property string $permission_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RolePivotPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RolePivotPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RolePivotPermission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RolePivotPermission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RolePivotPermission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RolePivotPermission wherePermissionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RolePivotPermission whereRoleCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RolePivotPermission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RolePivotPermission extends Model
{
    use HasLog, Named;

    ### Настройки
    ##################################################
    protected
        $table = 'sys__role_pivot_permission',
        $guarded = [];
}
