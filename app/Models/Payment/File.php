<?php

namespace App\Models\Payment;

use App\Models\Glossary\Bank;
use App\Models\Glossary\FileStatus;
use App\Traits\hasApi;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    ### Настройки
    ##################################################
    use Named, HasLog, HasFactory, hasApi;

    protected $table = 'payment__files';

    protected $fillable = [
        'disk',
        'path',
        'name',
        'origin_name',
        'errors',
        'error_context',

        'package_id',
        'bank_id',
        'status_id',
    ];

    public function casts(): array
    {
        return [
            'errors' => 'array',
            'error_context' => 'array',
        ];
    }

    ### Методы
    ##################################################
    public function setStatus(string $status)
    {
        $this->update([
            'status_id' => FileStatus::byCode($status)->id,
        ]);
    }

    public function addError(string $error, array|null $context = null)
    {
        $errors = $this->errors;
        $errors[] = $error;

        $this->update([
            'errors' => $errors,
            'error_context' => $context,
        ]);

        $this->setStatus('has-errors');

        return $this;
    }

    public function checkThisCSV()
    {
        return Storage::disk($this->disk)->mimeType($this->localPath()) === 'text/csv';
    }

    public function scopeLocalPath()
    {
        return $this->path !== ''
            ? $this->path . '/' . $this->name
            : $this->name;
    }

    public function scopeFullPath()
    {
        return Storage::disk($this->disk)->path($this->localPath);
    }

    public function scopeGetTotalSumm()
    {
        return $this->recipients->sum('summ');
    }

    ### Связи
    ##################################################
    public function status(): BelongsTo
    {
        return $this->belongsTo(FileStatus::class, 'status_id');
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'bank_id')->withTrashed();
    }

    public function recipients(): HasMany
    {
        return $this->hasMany(Recipient::class, 'file_id');
    }

    public function package(): HasOne
    {
        return $this->hasOne(Package::class, 'id', 'package_id');
    }
}
