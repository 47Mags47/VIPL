<?php

namespace App\Models\Main\Raports\Payment;

use App\Models\Glossary\Bank;
use App\Traits\HasLog;
use App\Traits\Named;
use App\Traits\ThisIsFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankFile extends Model
{
    use HasLog, Named, ThisIsFile, SoftDeletes;

    ### Настройки
    ##################################################
    protected
        $table = 'main__raports__payment__bank_files';

    protected $fillable = [
        'disk',
        'path',
        'name',
        'original_name',

        'status_id',
        'raport_id',
        'bank_id',
    ];

    ### Связи
    ##################################################
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }
}
