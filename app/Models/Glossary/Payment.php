<?php

namespace App\Models\Glossary;

use App\Models\Payment\Event;
use App\Traits\hasApi;
use Illuminate\Database\Eloquent\Model;

use App\Traits\HasFilter;
use App\Traits\HasLog;
use App\Traits\Named;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @var string $table glossary__payments
 *
 * @property \App\Models\Glossary\Law $law Модель закона на основании которого осуществляется выплата
 * @property \lluminate\Support\Collection $events [\App\Models\payment\Event] (событий) созданных на основе выплаты
 */
class Payment extends Model
{
    use Named, HasFilter, HasLog, hasApi, SoftDeletes;

    ### Настройки
    ##################################################
    protected $table = 'glossary__payments';

    protected $fillable = ['code', 'name', 'krv', 'kbk', 'law_id'];

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
