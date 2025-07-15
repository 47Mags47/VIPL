<?php

namespace App\Models\Payment;

use App\Traits\HasFilter;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Recipient extends Model
{
    use Named, HasFactory, HasFilter;

    ### Настройки
    ##################################################

    protected $table = 'payment__recipients';

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
