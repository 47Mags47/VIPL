<?php

namespace App\Models\Main;

use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

class AlertType extends Model
{
    use Named, hasCode;

    ### Настройки
    ##################################################
    protected
        $table = 'glossary__alert_types';

    protected $fillable = [
        'code',
        'name',
    ];

    public $timestamps = false;
}
