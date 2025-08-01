<?php

namespace App\Models\Glossary;

use App\Traits\hasApi;
use App\Traits\hasCode;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 *
 * @var string $table glossary__bank_exporters
 * @var bool $timestamps false
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankExporter api()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankExporter byCode(string $code)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankExporter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankExporter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankExporter query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankExporter whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankExporter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankExporter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankExporter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankExporter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BankExporter extends Model
{
    use hasApi, hasCode, HasLog, Named;

    ### Настройки
    ##################################################
    protected $table = 'glossary__bank_exporters';

    protected $fillable = ['code', 'name', 'type_id'];

    public $timestamps = false;

    ### Связи
    ##################################################
    public function banks(): HasMany
    {
        return $this->hasMany(Bank::class, 'exporter_id');
    }
}
