<?php

namespace App\Models\Glossary;

use App\Models\Sys\Glossary\ValidatorColumnType;
use App\Traits\hasApi;
use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @var string $table glossary__validator_columns
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $file_pos
 * @property int $required
 * @property array<array-key, mixed> $patterns
 * @property int $type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read ValidatorColumnType $type
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumn api()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumn byCode(string $code)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumn query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumn whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumn whereFilePos($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumn whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumn wherePatterns($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumn whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumn whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValidatorColumn whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ValidatorColumn extends Model
{
    use hasApi, hasCode, Named;

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
