<?php

namespace App\Traits;

trait Named
{
    public static function getTableName(){
        return (new self())->getTable();
    }
}
