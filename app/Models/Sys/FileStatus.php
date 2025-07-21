<?php

namespace App\Models\Sys;

use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

/**
 * @var string $table sys__file_statuses
 * @var bool $timestamps false
 */
class FileStatus extends Model
{
    use hasCode, Named;

    ### Настройки
    ##################################################
    protected $table = 'sys__file_statuses';

    protected $fillable = ['code', 'name', 'type'];

    public $timestamps = false;
}
