<?php

namespace App\Models\Sys;

use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

class RolePivotPermission extends Model
{
    use HasLog, Named;

    ### Настройки
    ##################################################
    protected
        $table = 'sys__role_pivot_permission',
        $guarded = [];
}
