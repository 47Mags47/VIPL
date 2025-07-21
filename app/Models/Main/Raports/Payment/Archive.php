<?php

namespace App\Models\Main\Raports\Payment;

use App\Traits\HasLog;
use App\Traits\Named;
use App\Traits\ThisIsFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Archive extends Model
{
    use HasLog, Named, ThisIsFile, SoftDeletes;

    ### Настройки
    ##################################################
    protected
        $table = 'main__raports__payment__bank_files_archives';

    protected $fillable = [
        'disk',
        'path',
        'name',
        'original_name',

        'raport_id',
    ];

}
