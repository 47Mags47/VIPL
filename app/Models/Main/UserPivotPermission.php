<?php

namespace App\Models\Main;

use App\Models\Sys\Permission;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
