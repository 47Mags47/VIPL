<?php

namespace App\Models\Glossary;

use App\Traits\hasApi;
use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

class ValidatorColumnType extends Model
{
    use Named, hasCode, hasApi;

    ### Настройки
    ##################################################
    protected $table = 'glossary__validator_column_types';

    protected $fillable = ['code'];

    public $timestamps = false;
}
