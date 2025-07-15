<?php

namespace App\Models\Glossary;

use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

/**
 * @var string $table glossary__file_status
 * @var bool $timestamps false
 */
class FileStatus extends Model
{
    use Named, hasCode;

    ### Настройки
    ##################################################
    protected $table = 'glossary__file_status';

    protected $fillable = ['name'];

    public $timestamps = false;
}
