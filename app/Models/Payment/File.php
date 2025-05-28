<?php

namespace App\Models\Payment;

use App\Models\Glossary\Bank;
use App\Models\Glossary\FileStatus;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    ### Настройки
    ##################################################
    use Named, HasLog, HasFactory;

    protected $table = 'payment__files';

    protected $fillable = [
        'path',
        'hash',
        'size',
        'errors',

        'package_id',
        'bank_id',
        'status_id',
    ];

    public function casts(): array
    {
        return [
            'errors' => 'array',
        ];
    }

    ### Методы
    ##################################################
    public function addError(string $error, array|null $context = null)
    {
        $errors = $this->errors;

        if ($context === null) {
            $errors[] = $error;
        } else {
            $errors[] = [$error => $context];
        }

        $this->update(['errors' => $errors]);
    }

    public function checkThisCSV()
    {
        return Storage::disk('ftp')->mimeType($this->path) === 'text/csv';
    }

    ### Связи
    ##################################################
    public function status(): BelongsTo
    {
        return $this->belongsTo(FileStatus::class, 'status_id');
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function recipients(): HasMany
    {
        return $this->hasMany(Recipient::class, 'file_id');
    }
}
