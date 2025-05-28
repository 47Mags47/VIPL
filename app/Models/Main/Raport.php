<?php

namespace App\Models\Main;

use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

class Raport extends Model
{
    use Named, HasLog;

    ### Настройки
    ##################################################
    protected
        $table = 'main__raports';

    protected $fillable = [
        'disk',
        'path',
        'name',
        'comment',
        'start_by'
    ];
}
