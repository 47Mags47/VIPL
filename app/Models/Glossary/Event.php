<?php

namespace App\Models\Glossary;

use App\Models\Main\Payment\Package;
use App\Models\Main\Raports\Payment\BankFile;
use App\Models\Main\Raports\Payment\Total;
use App\Models\Sys\FileStatus;
use App\Models\Sys\Payment\EventStatus;
use App\Traits\hasApi;
use App\Traits\HasFilter;
use App\Traits\Named;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class Event extends Model
{
    ### Настройки
    ##################################################
    use hasApi, HasFilter, Named, HasFactory;

    protected $table = 'main__payment__events';

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

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            if (empty($model->user)) {
                $model->npp = self::generateNPP();
            }
        });
    }

    ### Ограничения
    ##################################################
    public function scopeActive(Builder $builder): Builder
    {
        return $builder->whereNot('status_id', EventStatus::byCode('disabled')?->id);
    }

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

    /**
     * @return array Массив типа ['bank' => Bank, 'files' => [File...]]
     */
    public function filesGroupByBank()
    {
        $done_statuses = FileStatus::where('type', 'done')->get('id')->pluck('id')->toArray();

        $files = $this->packages->map(fn($package) => $package->files()->whereIn('status_id', $done_statuses)->get())->collapse();

        $files_groupBy_bank = [];
        foreach ($files as $file) {
            $files_groupBy_bank[$file->bank_id]['bank'] = $file->bank;
            $files_groupBy_bank[$file->bank_id]['files'][] = $file;
        }

        return array_values($files_groupBy_bank);
    }

    /**
     * @return array Массив типа ['division' => Division, 'files' => [File...]]
     */
    public function filesGroupByDivision()
    {
        $done_statuses = FileStatus::where('type', 'done')->get('id')->pluck('id')->toArray();

        $files = $this->packages->map(fn($package) => $package->files()->whereIn('status_id', $done_statuses)->get())->collapse();

        $files_groupBy_division = [];
        foreach ($files as $file) {
            $files_groupBy_division[$file->package->division_id]['division'] = $file->package->division;
            $files_groupBy_division[$file->package->division_id]['banks'][$file->bank_id]['bank'] = $file->bank;
            $files_groupBy_division[$file->package->division_id]['banks'][$file->bank_id]['files'][] = $file;
        }

        return array_values($files_groupBy_division);
    }

    public static function generateNPP()
    {
        return (Event::whereBetween('date', [now()->startOfYear(), now()->endOfYear()])->max('npp') ?? 0) + 1;
    }

    ### Связи
    ##################################################
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(EventStatus::class, 'status_id');
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
        return $this->hasMany(Total::class, 'event_id');
    }
}
