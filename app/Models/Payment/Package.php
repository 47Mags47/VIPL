<?php

namespace App\Models\Payment;

use App\Models\Glossary\Division;
use App\Models\Glossary\PackageStatus;
use App\Models\Payment\Raport;
use App\Traits\HasLog;
use App\Traits\hasUUID;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use Named, HasLog, hasUUID, HasFactory;

    ### Настройки
    ##################################################

    protected $table = 'payment__packages';

    protected $fillable = [
        'event_id',
        'division_id',
        'status_id'
    ];

    ### Связи
    ##################################################
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(PackageStatus::class, 'status_id');
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class, 'package_id');
    }

    public function raports(): HasMany
    {
        return $this->hasMany(Raport::class, 'id', 'package_id');
    }

    public function bankFiles(): HasMany
    {
        return $this->hasMany(BankFile::class, 'package_id', 'id');
    }

}
