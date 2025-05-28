<?php

namespace App\Traits;

use App\Classes\Filter;
use Illuminate\Database\Eloquent\Builder;

trait HasFilter
{
    /**
     * @param Builder $builder
     * @param Filter $filter
     * @return Builder
     */
    public function scopeFilter(Builder $builder, Filter $filter): Builder
    {
        return $filter->apply($builder);
    }
}
