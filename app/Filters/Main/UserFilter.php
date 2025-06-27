<?php

namespace App\Filters\Main;

use App\Classes\Filter;

class UserFilter extends Filter
{
    protected function search(string $value)
    {
        $value = '%' . $value . '%';

        return $this->builder->where(function ($query) use ($value) {
            return $query
                ->whereLike('name', $value)
                ->orWhereLike('email', $value);
        });
    }
}
