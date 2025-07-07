<?php

namespace App\Models\Payment;

use App\Models\Glossary\Payment;
use App\Traits\hasApi;
use App\Traits\Named;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class Event extends Model
{
    ### Настройки
    ##################################################
    use Named, hasApi;

    protected $table = 'payment__events';

    protected $fillable = [
        'date',
        'payment_id',
    ];

    public function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public $timestamps = false;

    ### Методы
    ##################################################

    /**
     * Возвращает коллекцию событий для заного периода
     *
     * @param Carbon|CarbonImmutable $start Дата начала периода
     * @param Carbon|CarbonImmutable $end Дата окончания периода
     * @return Collection
     */
    public static function compactToPeriod(Carbon|CarbonImmutable $start, Carbon|CarbonImmutable $end): Collection
    {
        return self::whereBetween('date', [$start, $end])->get()
            ->filter(function ($event) {
                $payment = $event->payment()->withTrashed()->first();

                if ($payment->trashed() and $event->date > $payment->deleted_at)
                    return false;

                return true;
            })
            ->map(function ($event) {
                return $event->toResource();
            })
            ->groupBy(fn($event) => $event->date->format('Y-m-d'));
    }

    public static function byDate(Carbon|CarbonImmutable $date)
    {
        return self::query()->where('date', $date)->get();
    }

    ### Связи
    ##################################################
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function packages(): HasMany
    {
        return $this->hasMany(Package::class, 'event_id');
    }

    public function files()
    {
        return $this->through('packages')->has('files');
    }

    public function bankFiles(): HasMany
    {
        return $this->hasMany(BankFile::class, 'event_id');
    }

    public function raports(): HasMany
    {
        return $this->hasMany(Raport::class, 'event_id');
    }
}
