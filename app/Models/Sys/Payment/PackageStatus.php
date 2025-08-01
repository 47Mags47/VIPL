<?php

namespace App\Models\Sys\Payment;

use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @var string $table sys__payment__package_statuses
 * @var bool $timestamps false
 * @property int $id
 * @property string $code
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PackageStatus byCode(string $code)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PackageStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PackageStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PackageStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PackageStatus whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PackageStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PackageStatus whereName($value)
 * @mixin \Eloquent
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
