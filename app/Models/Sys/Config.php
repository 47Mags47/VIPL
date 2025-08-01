<?php

namespace App\Models\Sys;

use App\Traits\hasApi;
use App\Traits\hasCode;
use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $code
 * @property string $type
 * @property array<array-key, mixed> $value
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Config api()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Config byCode(string $code)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Config newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Config newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Config query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Config whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Config whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Config whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Config whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Config whereValue($value)
 * @mixin \Eloquent
 */
class Config extends Model
{
    use hasApi, hasCode, HasLog;

    ### Настройки
    ##################################################
    protected
        $table = 'sys__config';

    protected $fillable = [
        'code',
        'value',
    ];

    public function casts(): array
    {
        return [
            'value' => 'array',
        ];
    }

    public $timestamps = false;
}
