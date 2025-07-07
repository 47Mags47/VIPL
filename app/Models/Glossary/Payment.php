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
use Illuminate\Support\Carbon;

class Payment extends Model
{
    use Named, HasFilter, HasLog, hasApi, SoftDeletes;

    ### Настройки
    ##################################################
    protected $table = 'glossary__payments';

    protected $fillable = ['code', 'name', 'krv', 'kbk', 'law_id', 'periodicity_id', 'start_at'];

    public function casts(): array
    {
        return [
            'start_at' => 'date',
        ];
    }

    ### Методы
    ##################################################

    /**
     * Создает события для заданого периода
     *
     * @param Carbon|CarbonImmutable $start Дата начала периода
     * @param Carbon|CarbonImmutable $end Дата окончания периода
     * @return void
     */
    public static function createEventsToPeriod(Carbon|CarbonImmutable $start, Carbon|CarbonImmutable $end)
    {
        self::get()->each(function ($payment) use ($start, $end) {
            $period = $start->toPeriod($end);
            $payment_period = $payment->start_at->toPeriod($end, $payment->periodicity->carbon);

            $event_period_start = max($period->getStartDate(), $payment_period->getStartDate());

            $event_period_end = $payment->trashed()
                ? $payment->deleted_at
                : min($period->calculateEnd(), $payment_period->calculateEnd());
            $event_period = $event_period_start->toPeriod($event_period_end, $payment->periodicity->carbon);

            foreach ($event_period->toArray() as $date) {
                Event::firstOrCreate([
                    'payment_id' => $payment->id,
                    'date' => $date
                ]);
            }
        });
    }

    ### Связи
    ##################################################
    public function periodicity(): BelongsTo
    {
        return $this->belongsTo(PaymentPeriodicity::class, 'periodicity_id');
    }

    public function law(): BelongsTo
    {
        return $this->belongsTo(Law::class, 'law_id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'payment_id');
    }
}
