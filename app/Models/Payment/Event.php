<?php

namespace App\Models\Payment;

use App\Models\Glossary\Payment;
use App\Traits\Named;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Event extends Model
{
    ### Настройки
    ##################################################
    use Named;

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

    public function files(){
        return $this->through('packages')->has('files');
    }

    public function bankFiles(): HasMany
    {
        return $this->hasMany(BankFile::class, 'event_id');
    }

    public function raports():HasMany
    {
        return $this->hasMany(Raport::class, 'event_id');
    }
}
