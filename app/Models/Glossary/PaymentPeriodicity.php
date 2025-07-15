<?php

namespace App\Models\Glossary;

use App\Traits\hasApi;
use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

/**
 * @var string $table glossary__payment_periodicity
 * @var bool $timestamps false
 */
class PaymentPeriodicity extends Model
{
    use Named, hasCode, hasApi;

    ### Настройки
    ##################################################

    protected $table = 'glossary__payment_periodicity';

    protected $fillable = ['code', 'name'];

    public $timestamps = false;
}
