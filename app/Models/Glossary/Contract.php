<?php

namespace App\Models\Glossary;

use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @var string $table glossary__contracts
 * @property int $id
 * @property string $number
 * @property \Illuminate\Support\Carbon $signed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereSignedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contract withoutTrashed()
 * @mixin \Eloquent
 */
class Contract extends Model
{
    use HasLog, Named, SoftDeletes;

    ### Настройки
    ##################################################
    protected $table = 'glossary__contracts';

    protected $fillable = [
        'number',
        'signed_at',
    ];

    public function casts(): array
    {
        return [
            'signed_at' => 'date',
        ];
    }

    ### Связи
    ##################################################
    public function banks(): HasMany
    {
        return $this->hasMany(Bank::class, 'contract_id');
    }
}
