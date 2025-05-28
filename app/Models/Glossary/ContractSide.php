<?php

namespace App\Models\Glossary;

use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractSide extends Model
{
    use Named, HasLog, SoftDeletes;

    ### Настройки
    ##################################################
    protected $table = 'glossary__contract_sides';

    protected $fillable = [
        'name',
        'INN',
        'account',
        'BIK'
    ];
}
