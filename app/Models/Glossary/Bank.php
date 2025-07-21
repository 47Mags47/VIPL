<?php

namespace App\Models\Glossary;

use App\Models\Main\Payment\File;
use App\Traits\hasApi;
use App\Traits\HasFilter;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @var string $table glossary__banks
 *
 * @property \App\Models\Glossary\BankExporter $exporter Модель экспортера для формирования файлов в банк
 * @property \App\Models\Glossary\Contract $contract Модель договора с банком
 * @property \lluminate\Support\Collection $files [App\Models\Payment\File] (файлов) на выплату
 */
class Bank extends Model
{
    use hasApi, HasFilter, HasLog, Named, SoftDeletes;

    ### Настройки
    ##################################################
    protected $table = 'glossary__banks';

    protected $fillable = [
        'number_code',
        'code',
        'name',

        'exporter_id',
        'contract_id'
    ];

    ### Связи
    ##################################################
    public function exporter(): BelongsTo
    {
        return $this->belongsTo(BankExporter::class, 'exporter_id');
    }

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class, 'bank_id');
    }
}
