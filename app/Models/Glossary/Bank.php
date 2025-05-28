<?php

namespace App\Models\Glossary;

use App\Traits\HasFilter;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bank extends Model
{
    use Named, HasFilter, HasLog;

    ### Настройки
    ##################################################
    protected $table = 'glossary__banks';

    protected $fillable = [
        'number_code',
        'code',
        'name',

        'template_id',
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
