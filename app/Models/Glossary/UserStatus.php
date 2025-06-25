<?php

namespace App\Models\Glossary;

use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    use Named, hasCode;

    ### Настройки
    ##################################################
    protected $table = 'glossary__user_statusses';

    protected $fillable = ['code', 'name'];

    public $timestamps = false;
}
