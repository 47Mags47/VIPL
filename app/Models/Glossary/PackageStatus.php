<?php

namespace App\Models\Glossary;

use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

class PackageStatus extends Model
{
    use Named, hasCode;

    ### Настройки
    ##################################################
    protected $table = 'glossary__package_status';

    protected $fillable = ['code', 'name'];

    public $timestamps = false;

}
