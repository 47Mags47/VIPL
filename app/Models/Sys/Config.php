<?php

namespace App\Models\Sys;

use App\Traits\hasApi;
use App\Traits\hasCode;
use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use hasApi, hasCode, HasLog;

    ### Настройки
    ##################################################
    protected
        $table = 'sys__config';

    protected $fillable = [
        'code',
        'value',
    ];

    public function casts(): array
    {
        return [
            'value' => 'array',
        ];
    }

    public $timestamps = false;
}
