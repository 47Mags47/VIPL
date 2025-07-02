<?php

namespace App\Models\Glossary;

use App\Traits\hasApi;
use App\Traits\HasFilter;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use Named, HasFilter, HasLog, hasApi, SoftDeletes;

    ### Настройки
    ##################################################
    protected $table = 'glossary__banks';

    protected $fillable = [
        'number_code',
        'code',
        'name',

        'exporter_id',
        'contract_id'
    ];

    ### Связи
    ##################################################
    public function exporter():BelongsTo
    {
        return $this->belongsTo(BankExporter::class, 'exporter_id');
    }

    public function contract():BelongsTo
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
}
