<?php

namespace App\Models\Main;

use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alert extends Model
{
    use Named;

    ### Настройки
    ##################################################
    protected
        $table = 'main__alerts';

    protected $fillable = [
        'to_id',
        'message',
        'type_id',
    ];

    ### Связи
    ##################################################
    public function type(): BelongsTo
    {
        return $this->belongsTo(AlertType::getTableName(), 'type_id');
    }
}
