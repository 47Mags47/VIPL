<?php

namespace App\Models\Main\Payment;

use App\Traits\HasFilter;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
