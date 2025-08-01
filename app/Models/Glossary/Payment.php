<?php

namespace App\Models\Glossary;

use App\Models\Glossary\Event;
use App\Traits\hasApi;
use App\Traits\HasFilter;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @var string $table glossary__payments
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $kbk
 * @property int $law_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Event> $events
 * @property-read int|null $events_count
 * @property-read \App\Models\Glossary\Law $law
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment api()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment filter(\App\Classes\Filter $filter)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereKbk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereLawId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment withoutTrashed()
 * @mixin \Eloquent
 */
class Payment extends Model
{
    use hasApi, HasFilter, HasLog, Named, SoftDeletes;

    ### Настройки
    ##################################################
    protected $table = 'glossary__payments';

    protected $fillable = ['code', 'name', 'kbk', 'law_id'];

    ### Связи
    ##################################################
    public function law(): BelongsTo
    {
        return $this->belongsTo(Law::class, 'law_id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'payment_id');
    }
}
