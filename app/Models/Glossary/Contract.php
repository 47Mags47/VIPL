<?php

namespace App\Models\Glossary;

use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @var string $table glossary__contracts
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
}
