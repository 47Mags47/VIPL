<?php

namespace App\Models\Glossary;

use App\Traits\HasFilter;
use App\Traits\HasLog;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use Named, HasLog, HasFilter;

    ### Настройки
    ##################################################
    protected $table = 'glossary__divisions';

    protected $fillable = ['code', 'name'];
}
