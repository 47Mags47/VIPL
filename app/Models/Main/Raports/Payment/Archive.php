<?php

namespace App\Models\Main\Raports\Payment;

use App\Traits\HasLog;
use App\Traits\Named;
use App\Traits\ThisIsFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property string $disk
 * @property string $path
 * @property string $name
 * @property string $original_name
 * @property int $raport_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Archive newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Archive newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Archive onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Archive query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Archive whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Archive whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Archive whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Archive whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Archive whereOriginalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Archive wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Archive whereRaportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Archive whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Archive withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Archive withoutTrashed()
 * @mixin \Eloquent
 */
class Archive extends Model
{
    use HasLog, Named, ThisIsFile, SoftDeletes;

    ### Настройки
    ##################################################
    protected
        $table = 'main__raports__payment__bank_files_archives';

    protected $fillable = [
        'disk',
        'path',
        'name',
        'original_name',

        'raport_id',
    ];

}
