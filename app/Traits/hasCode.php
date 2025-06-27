<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait hasCode
{
    public static function byCode(string $code){
        return self::query()->where('code', $code)->first();
    }

    public function scopeByCode(Builder $builder, string $code){
        return $builder->where('code', $code)->get()->first();
    }
}
