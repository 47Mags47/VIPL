<?php

namespace App\Models\Glossary;

use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use Named, HasLog, SoftDeletes;

    ### Настройки
    ##################################################
    protected $table = 'glossary__contracts';

    protected $fillable = [
        'number',
        'signed_at',
        'division_side_id',
        'bank_side_id',
    ];

    public function casts(): array
    {
        return [
            'signed_at' => 'date',
        ];
    }

    ### Связи
    ##################################################
    public function bank(): HasMany
    {
        return $this->hasMany(Bank::class, 'bank_id');
    }
}
