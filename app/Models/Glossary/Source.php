<?php

namespace App\Models\Glossary;

use App\Traits\hasApi;
use App\Traits\hasCode;
use App\Traits\HasFilter;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @var string $table glossary__sources
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source api()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source byCode(string $code)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source filter(\App\Classes\Filter $filter)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Source extends Model
{
    use hasApi, hasCode, HasFilter, HasLog, Named, SoftDeletes;

    ### Настройки
    ##################################################
    protected $table = 'glossary__sources';

    protected $fillable = [
        'code',
        'name',
    ];

    ### Связи
    ##################################################
    public function laws(): HasMany
    {
        return $this->hasMany(Law::class, 'source_id');
    }
}
