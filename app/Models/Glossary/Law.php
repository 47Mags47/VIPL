<?php

namespace App\Models\Glossary;

use App\Traits\hasCode;
use App\Traits\HasFilter;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Law extends Model
{
    use Named, hasCode, HasLog, HasFilter;

    ### Настройки
    ##################################################
    protected $table = 'glossary__laws';

    protected $fillable = [
        'code',
        'name',
        'source_id',
    ];

    ### Связи
    ##################################################
    public function source():BelongsTo
    {
        return $this->belongsTo(Source::class, 'source_id');
    }
}
