<?php

namespace App\Models\Sys;

use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

/**
 * @var string $table sys__user_statusses
 * @var bool $timestamps false
 */
class UserStatus extends Model
{
    use hasCode, Named;

    ### Настройки
    ##################################################
    protected $table = 'sys__user_statusses';

    protected $fillable = ['code', 'name'];

    public $timestamps = false;
}
