<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait hasApi
{
    public function scopeApi(Builder $builder) {
        return $builder->paginate(50)->toResourceCollection();
    }

    public static function api()
    {
        return self::paginate(50)->toResourceCollection();
    }
}
