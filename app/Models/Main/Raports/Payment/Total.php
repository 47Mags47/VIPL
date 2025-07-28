<?php

namespace App\Models\Main\Raports\Payment;

use App\Events\Payment\Raport\ChangeStatusEvent;
use App\Models\Glossary\Event;
use App\Models\Main\Payment\Package;
use App\Models\Main\Raports\Payment\BankFile;
use App\Models\Main\User;
use App\Models\Sys\FileStatus;
use App\Traits\HasLog;
use App\Traits\Named;
use App\Traits\ThisIsFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Total extends Model
{
    use HasLog, Named, ThisIsFile, SoftDeletes;

    ### Настройки
    ##################################################
    protected
        $table = 'main__raports__payment__totals';

    protected $fillable = [
        'disk',
        'path',
        'name',
        'original_name',

        'event_id',
        'start_by',
        'status_id'
    ];

    ### Методы
    ##################################################
    public function download()
    {
        return Storage::disk($this->disk)->download($this->getLocalPath(), $this->original_name);
    }

    public function setStatus(string $status)
    {
        $this->update(['status_id' => FileStatus::byCode($status)?->id]);

        ChangeStatusEvent::dispatch($this);
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

    public function status(): BelongsTo
    {
        return $this->belongsTo(FileStatus::class, 'status_id');
    }

    public function startBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'start_by');
    }
}
