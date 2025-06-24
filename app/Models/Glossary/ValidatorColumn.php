<?php

namespace App\Models\Glossary;

use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ValidatorColumn extends Model
{
    use Named, hasCode;

    ### Настройки
    ##################################################
    protected $table = 'glossary__validator_columns';

    protected $fillable = [
        'code',
        'name',
        'file_pos',
        'type_id',
        'required',
        'default',
        'patterns'
    ];

    public function casts(): array
    {
        return [
            'patterns' => 'array',
        ];
    }

    ### Связи
    ##################################################
    public function type(): BelongsTo
    {
        return $this->belongsTo(ValidatorColumnType::class, 'type_id');
    }
}
