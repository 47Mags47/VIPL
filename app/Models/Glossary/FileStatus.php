<?php

namespace App\Models\Glossary;

use App\Traits\hasCode;
use App\Traits\Named;
use Illuminate\Database\Eloquent\Model;

class FileStatus extends Model
{
    use Named, hasCode;

    ### Настройки
    ##################################################
    protected $table = 'glossary__file_status';

    protected $fillable = ['name'];

    public $timestamps = false;

    ### Методы
    ##################################################
    public function restore(string $path)
    {
        self::staticRestore($path, $this->database, $this->getUserString());
    }
}
