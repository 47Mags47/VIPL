<?php

namespace App\Models\Glossary;

use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

/**
 * @var string $table glossary__user_statusses
 * @var bool $timestamps false
 */
class UserStatus extends Model
{
    use Named, hasCode;

    ### Настройки
    ##################################################
    protected $table = 'glossary__user_statusses';

    protected $fillable = ['code', 'name'];

    public $timestamps = false;
}
