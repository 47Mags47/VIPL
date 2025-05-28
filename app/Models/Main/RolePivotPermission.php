<?php

namespace App\Models\Main;

use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

class RolePivotPermission extends Model
{
    use Named, HasLog;

    ### Настройки
    ##################################################
    protected
        $table = 'main__role_pivot_permission',
        $guarded = [];
}
