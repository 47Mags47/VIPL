<?php

namespace App\Models\Glossary;

use App\Models\Payment\Event;
use App\Traits\hasApi;
use Illuminate\Database\Eloquent\Model;

use App\Traits\HasFilter;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    use Named, HasFilter, HasLog, hasApi;

    ### Настройки
    ##################################################
    protected $table = 'glossary__payments';

    protected $fillable = ['code', 'name', 'krv', 'kbk', 'law_id', 'periodicity_id'];

    ### Методы
    ##################################################
    public static function generate()
    {
        $payments = self::get();

        $start_date = now();
        $end_date = now()->addYear(1);

        foreach ($payments as $payment) {
            foreach ($start_date->toPeriod($end_date, $payment->periodicity->carbon)->toArray() as $date) {
                Event::firstOrCreate(['date' => $date->format('Y-m-d'), 'payment_id' => $payment->id])->id;
            }
        }
    }

    ### Связи
    ##################################################
    public function periodicity() :BelongsTo
    {
        return $this->belongsTo(PaymentPeriodicity::class, 'periodicity_id');
    }

    public function law():BelongsTo
    {
        return $this->belongsTo(Law::class, 'law_id');
    }

    public function events() :HasMany{
        return $this->hasMany(Event::class, 'payment_id');
    }
}
