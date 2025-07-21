<?php

namespace App\Models\Sys\Glossary;

use App\Traits\hasApi;
use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

/**
 * @var string $table sys__validator_column_types
 * @var bool $timestamps false
 */
class ValidatorColumnType extends Model
{
    use hasApi, hasCode, Named;

    ### Настройки
    ##################################################
    protected $table = 'sys__validator_column_types';

    protected $fillable = ['code'];

    public $timestamps = false;
}
