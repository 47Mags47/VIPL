<?php

namespace App\Models\Main\Raports\Payment;

use App\Models\Glossary\Bank;
use App\Traits\HasLog;
use App\Traits\Named;
use App\Traits\ThisIsFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property string $disk
 * @property string $path
 * @property string $name
 * @property string $original_name
 * @property int $status_id
 * @property int $raport_id
 * @property int $bank_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Bank $bank
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankFile onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankFile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankFile whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankFile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankFile whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankFile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankFile whereOriginalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankFile wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankFile whereRaportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankFile whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankFile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankFile withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankFile withoutTrashed()
 * @mixin \Eloquent
 */
class BankFile extends Model
{
    use HasLog, Named, ThisIsFile, SoftDeletes;

    ### Настройки
    ##################################################
    protected
        $table = 'main__raports__payment__bank_files';

    protected $fillable = [
        'disk',
        'path',
        'name',
        'original_name',

        'status_id',
        'raport_id',
        'bank_id',
    ];

    ### Связи
    ##################################################
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }
}
