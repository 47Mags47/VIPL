<?php

namespace App\Models\Sys;

use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @var string $table sys__file_statuses
 * @var bool $timestamps false
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileStatus byCode(string $code)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileStatus whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FileStatus whereType($value)
 * @mixin \Eloquent
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
