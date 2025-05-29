<?php

namespace App\Models\Glossary;

use App\Traits\hasCode;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentLaw extends Model
{
    use Named, hasCode, HasLog;

    ### Настройки
    ##################################################
    protected $table = 'glossary__payment_laws';

    protected $fillable = [
        'code',
        'name',
        'source_id',
    ];

    ### Связи
    ##################################################
    public function source():BelongsTo
    {
        return $this->belongsTo(PaymentSource::class, 'source_id');
    }
}
