<?php

namespace App\Models\Payment;

use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Archive extends Model
{
    use Named, HasLog, SoftDeletes;

    ### Настройки
    ##################################################
    protected
        $table = 'payment__archives';

    protected $fillable = [
        'disk',
        'path',
        'name',
        'original_name',

        'raport_id',
    ];

}
