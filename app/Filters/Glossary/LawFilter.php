<?php

namespace App\Filters\Glossary;

use App\Classes\Filter;

class LawFilter extends Filter
{
    protected function search(string $value)
    {
        $value = '%' . $value . '%';

        return $this->builder->where(function ($query) use ($value) {
            return $query
                ->orWhereLike('code', $value)
                ->orWhereLike('name', $value);
        });
    }
}
