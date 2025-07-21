<?php

namespace App\Models\Sys\Payment;

use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

/**
 * @var string $table sys__payment__package_statuses
 * @var bool $timestamps false
 */
class PackageStatus extends Model
{
    use hasCode, Named;

    ### Настройки
    ##################################################
    protected $table = 'sys__payment__package_statuses';

    protected $fillable = ['code', 'name'];

    public $timestamps = false;

}
