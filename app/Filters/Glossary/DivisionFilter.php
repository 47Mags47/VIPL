<?php

namespace App\Filters\Glossary;

use App\Classes\Filter;

class DivisionFilter extends Filter
{
    protected function search(string $value)
    {
        $value = '%' . $value . '%';

        return $this->builder->where(function ($query) use ($value) {
            return $query
                ->whereLike('code', $value)
                ->orWhereLike('name', $value);
        });
    }
}
