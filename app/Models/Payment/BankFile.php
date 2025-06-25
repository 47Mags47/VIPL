<?php

namespace App\Models\Payment;

use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

class BankFile extends Model
{
    use Named, HasLog;

    ### Настройки
    ##################################################
    protected
        $table = 'payment__bank_files';

    protected $fillable = [
        'disk',
        'path',
        'name',
        'original_name',

        'raport_id',
        'event_id',
        'bank_id',
    ];

    public function scopeLocalPath()
    {
        return $this->path !== ''
            ? $this->path . '/' . $this->name
            : $this->name;
    }
}
