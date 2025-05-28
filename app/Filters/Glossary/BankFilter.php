<?php

namespace App\Filters\Glossary;

use App\Classes\Filter;

class BankFilter extends Filter
{
    protected function search(string $value)
    {
        $value = '%' . $value . '%';

        return $this->builder->where(function ($query) use ($value) {
            return $query
                ->whereLike('number_code', $value)
                ->orWhereLike('code', $value)
                ->orWhereLike('name', $value);
        });
    }
}
