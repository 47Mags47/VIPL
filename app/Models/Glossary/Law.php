<?php

namespace App\Models\Glossary;

use App\Traits\hasApi;
use App\Traits\hasCode;
use App\Traits\HasFilter;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 *
 * @var string $table glossary__laws
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int|null $source_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\Glossary\Source|null $source
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Law api()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Law byCode(string $code)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Law filter(\App\Classes\Filter $filter)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Law newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Law newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Law query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Law whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Law whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Law whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Law whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Law whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Law whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Law extends Model
{
    use hasApi, hasCode, HasFilter, HasLog, Named;

    ### Настройки
    ##################################################
    protected $table = 'glossary__laws';

    protected $fillable = [
        'code',
        'name',
        'source_id',
    ];

    ### Связи
    ##################################################
    public function source():BelongsTo
    {
        return $this->belongsTo(Source::class, 'source_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'law_id');
    }
}
