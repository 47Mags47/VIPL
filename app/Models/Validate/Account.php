<?php

namespace App\Models\Validate;

use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    ### Настройки
    ##################################################
    use Named;

    protected $table = 'validate__accounts';

    protected $fillable = [
        'rule',
    ];
}
