<?php

namespace App\Models\Main\Payment;

use App\Models\Glossary\Division;
use App\Models\Glossary\Event;
use App\Models\Main\Raports\Payment\BankFile;
use App\Models\Main\Raports\Payment\Total;
use App\Models\Sys\Payment\PackageStatus;
use App\Traits\hasApi;
use App\Traits\HasLog;
use App\Traits\hasUUID;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property string $id
 * @property int $division_id
 * @property int $event_id
 * @property int $status_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, BankFile> $bankFiles
 * @property-read int|null $bank_files_count
 * @property-read Division $division
 * @property-read Event $event
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Main\Payment\File> $files
 * @property-read int|null $files_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Total> $raports
 * @property-read int|null $raports_count
 * @property-read PackageStatus $status
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package api()
 * @method static \Database\Factories\Main\Payment\PackageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package getTotalSumm()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereDivisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Package whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Package extends Model
{
    use hasApi, HasLog, hasUUID, Named, HasFactory;

    ### Настройки
    ##################################################

    protected $table = 'main__payment__packages';

    protected $fillable = [
        'event_id',
        'division_id',
        'status_id'
    ];

    ### Методы
    ##################################################
    public function scopeGetTotalSumm(){
        return $this->files->sum(fn($file) => $file->getTotalSumm());
    }

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
        return $this->hasMany(Total::class, 'id', 'package_id');
    }

    public function bankFiles(): HasMany
    {
        return $this->hasMany(BankFile::class, 'package_id', 'id');
    }

}
