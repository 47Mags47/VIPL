<?php

namespace App\Models\Glossary;

use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

class ContractSideType extends Model
{
    use Named, hasCode;

    ### Настройки
    ##################################################
    protected $table = 'glossary__contract_side_type';

    protected $fillable = ['code', 'name'];

    public $timestamps = false;
}
