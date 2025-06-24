<?php

namespace App\Models\Payment;

use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Raport extends Model
{
    use Named, HasLog;

    ### Настройки
    ##################################################
    protected
        $table = 'payment__raports';

    protected $fillable = [
        'disk',
        'path',
        'name',
        'original_name',

        'event_id',
        'start_by',
    ];

    public function scopeLocalPath()
    {
        return $this->path !== ''
            ? $this->path . '/' . $this->name
            : $this->name;
    }

    ### Связи
    ##################################################
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function packages(): HasMany
    {
        return $this->hasMany(Package::class, 'event_id', 'event_id');
    }

    public function bankFiles(): HasMany
    {
        return $this->hasMany(BankFile::class, 'raport_id', 'id');
    }
}
