<?php

namespace App\Models\Glossary;

use App\Models\Main\Payment\File;
use App\Models\Main\Raports\Payment\BankFile;
use App\Traits\hasApi;
use App\Traits\HasFilter;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 *
 *
 * @var string $table glossary__banks
 * @property int $id
 * @property string $number_code
 * @property string $code
 * @property string $name
 * @property int $exporter_id
 * @property int|null $contract_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\Glossary\Contract|null $contract
 * @property-read \App\Models\Glossary\BankExporter $exporter
 * @property-read \Illuminate\Database\Eloquent\Collection<int, File> $files
 * @property-read int|null $files_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank api()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank filter(\App\Classes\Filter $filter)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank whereExporterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank whereNumberCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank withoutTrashed()
 * @mixin \Eloquent
 */
class Bank extends Model
{
    use hasApi, HasFilter, HasLog, Named, SoftDeletes;

    ### Настройки
    ##################################################
    protected $table = 'glossary__banks';

    protected $fillable = [
        'number_code',
        'code',
        'name',

        'exporter_id',
        'contract_id'
    ];

    public static function boot()
    {
        parent::boot();

        self::deleting(function ($model) {
            $model->bankFiles()->delete();
        });
    }

    ### Связи
    ##################################################
    public function exporter(): BelongsTo
    {
        return $this->belongsTo(BankExporter::class, 'exporter_id');
    }

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class, 'bank_id');
    }

    public function bankFiles(): HasMany
    {
        return $this->hasMany(BankFile::class, 'bank_id');
    }
}
