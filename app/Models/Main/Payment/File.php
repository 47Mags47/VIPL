<?php

namespace App\Models\Main\Payment;

use App\Events\Main\Payment\File\CreateEvent;
use App\Events\Main\Payment\Package\DeleteFileEvent;
use App\Events\Main\Payment\Package\UpdateFileListEvent;
use App\Jobs\Payment\Files\ReadToDB;
use App\Models\Glossary\Bank;
use App\Models\Sys\FileStatus;
use App\Traits\hasApi;
use App\Traits\HasLog;
use App\Traits\Named;
use App\Traits\ThisIsFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    ### Настройки
    ##################################################
    use hasApi, HasLog, Named, HasFactory, ThisIsFile;

    protected $table = 'main__payment__files';

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

    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            ReadToDB::dispatch($model);
            broadcast(new CreateEvent($model))->toOthers();
            broadcast(new UpdateFileListEvent($model->package))->toOthers();
        });

        self::deleting(function ($model) {
            broadcast(new DeleteFileEvent($model))->toOthers();
            broadcast(new UpdateFileListEvent($model->package))->toOthers();
        });
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
        return Storage::disk($this->disk)->mimeType($this->getLocalPath()) === 'text/csv';
    }

    public function scopeGetTotalSumm()
    {
        return $this->recipients->sum('summ');
    }

    public function getHash(): string
    {
        return Storage::disk($this->disk)->checksum($this->getLocalPath());
    }

    public function getSize(): string
    {
        return formatSizeUnits(Storage::disk($this->disk)->size($this->getLocalPath()));
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
