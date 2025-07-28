<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait hasApi
{
    public function scopeApi(Builder $builder) {
        return $builder->paginate(25)->toResourceCollection();
    }

    public static function api()
    {
        return self::paginate(25)->toResourceCollection();
    }
}
