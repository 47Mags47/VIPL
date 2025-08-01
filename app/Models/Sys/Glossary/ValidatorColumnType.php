<?php

namespace App\Models\Sys\Glossary;

use App\Traits\hasApi;
use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @var string $table sys__validator_column_types
 * @var bool $timestamps false
 * @property int $id
 * @property string $code
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumnType api()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumnType byCode(string $code)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumnType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumnType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumnType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumnType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumnType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumnType whereName($value)
 * @mixin \Eloquent
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
