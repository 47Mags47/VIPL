<?php

namespace App\Models\Payment;

use App\Models\Glossary\Bank;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankFile extends Model
{
    use Named, HasLog, SoftDeletes;

    ### Настройки
    ##################################################
    protected
        $table = 'payment__bank_files';

    protected $fillable = [
        'disk',
        'path',
        'name',
        'original_name',

        'raport_id',
        'event_id',
        'bank_id',
    ];

    public function scopeLocalPath()
    {
        return $this->path !== ''
            ? $this->path . '/' . $this->name
            : $this->name;
    }

    ### Связи
    ##################################################
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }
}
