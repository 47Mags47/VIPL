<?php

namespace App\Models\Payment;

use App\Models\Glossary\FileStatus;
use App\Models\Main\User;
use App\Traits\HasLog;
use App\Traits\Named;
use App\Traits\ThisIsFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Raport extends Model
{
    use Named, HasLog, SoftDeletes, ThisIsFile;

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
