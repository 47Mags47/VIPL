<?php

namespace App\Models\Importer;

use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

class ValidateColumnType extends Model
{
    use Named, hasCode;

    ### Настройки
    ##################################################
    protected $table = 'importer__validator_column_types';

    protected $fillable = ['code'];

    public $timestamps = false;
}
