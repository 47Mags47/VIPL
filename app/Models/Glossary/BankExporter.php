<?php

namespace App\Models\Glossary;

use App\Traits\hasApi;
use App\Traits\hasCode;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

class BankExporter extends Model
{
    use Named, hasCode, HasLog, hasApi;

    ### Настройки
    ##################################################
    protected $table = 'glossary__bank_exporters';

    protected $fillable = ['code', 'name', 'type_id'];

    public $timestamps = false;
}
