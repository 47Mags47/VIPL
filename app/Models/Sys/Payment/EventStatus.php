<?php

namespace App\Models\Sys\Payment;

use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

class EventStatus extends Model
{
    use hasCode, Named;

    ### Настройки
    ##################################################
    protected $table = 'sys__payment__event_statuses';

    protected $fillable = ['code', 'name'];

    public $timestamps = false;
}
