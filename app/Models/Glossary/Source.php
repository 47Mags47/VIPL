<?php

namespace App\Models\Glossary;

use App\Traits\hasApi;
use App\Traits\hasCode;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

/**
 * @var string $table glossary__sources
 */
class Source extends Model
{
    use Named, hasCode, HasLog, hasApi;

    ### Настройки
    ##################################################
    protected $table = 'glossary__sources';

    protected $fillable = [
        'code',
        'name',
    ];
}
