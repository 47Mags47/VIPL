<?php

namespace App\Models\Main\Payment;

use App\Traits\HasFilter;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * 
 *
 * @property int $id
 * @property int $file_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $middle_name
 * @property \Illuminate\Support\Carbon|null $d_rojd
 * @property string|null $snils
 * @property string|null $account
 * @property float|null $summ
 * @property string|null $p_series
 * @property string|null $p_number
 * @property \Illuminate\Support\Carbon|null $p_date
 * @property string|null $p_div
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Main\Payment\File|null $file
 * @method static \Database\Factories\Main\Payment\RecipientFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient filter(\App\Classes\Filter $filter)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereDRojd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient wherePDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient wherePDiv($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient wherePNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient wherePSeries($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereSnils($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereSumm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipient whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Recipient extends Model
{
    use HasFilter, Named, HasFactory;

    ### Настройки
    ##################################################

    protected $table = 'main__payment__recipients';

    protected $fillable = [
        'file_id',

        'first_name',
        'last_name',
        'middle_name',
        'd_rojd',
        'snils',

        'account',
        'summ',
        'kbk',

        'p_series',
        'p_number',
        'p_date',
        'p_div',
    ];

    public function casts(): array
    {
        return [
            'd_rojd' => 'date',
            'p_date' => 'date'
        ];
    }

    ### Связи
    ##################################################
    public function file(): HasOne
    {
        return $this->hasOne(File::class, 'id', 'file_id');
    }
}
