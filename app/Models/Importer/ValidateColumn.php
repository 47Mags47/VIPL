<?php

namespace App\Models\Importer;

use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ValidateColumn extends Model
{
    use Named, hasCode;

    ### Настройки
    ##################################################
    protected $table = 'importer__validator_columns';

    protected $fillable = ['code', 'name', 'file_pos', 'type_id', 'required', 'default', 'patterns'];

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
        return $this->belongsTo(ValidateColumnType::class, 'type_id');
    }
}
