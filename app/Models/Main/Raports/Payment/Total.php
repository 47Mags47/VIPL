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

/**
 * 
 *
 * @property int $id
 * @property string $disk
 * @property string $path
 * @property string $name
 * @property string $original_name
 * @property int $status_id
 * @property int $event_id
 * @property int $start_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, BankFile> $bankFiles
 * @property-read int|null $bank_files_count
 * @property-read Event $event
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Package> $packages
 * @property-read int|null $packages_count
 * @property-read User $startBy
 * @property-read FileStatus $status
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Total newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Total newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Total onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Total query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Total whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Total whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Total whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Total whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Total whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Total whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Total whereOriginalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Total wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Total whereStartBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Total whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Total whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Total withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Total withoutTrashed()
 * @mixin \Eloquent
 */
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
