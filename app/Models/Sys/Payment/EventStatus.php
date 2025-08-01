<?php

namespace App\Models\Sys\Payment;

use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventStatus byCode(string $code)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventStatus whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventStatus whereName($value)
 * @mixin \Eloquent
 */
class EventStatus extends Model
{
    use hasCode, Named;

    ### Настройки
    ##################################################
    protected $table = 'sys__payment__event_statuses';

    protected $fillable = ['code', 'name'];

    public $timestamps = false;
}
