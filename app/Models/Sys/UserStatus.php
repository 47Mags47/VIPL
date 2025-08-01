<?php

namespace App\Models\Sys;

use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @var string $table sys__user_statusses
 * @var bool $timestamps false
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserStatus byCode(string $code)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserStatus whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserStatus whereUpdatedAt($value)
 * @mixin \Eloquent
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
