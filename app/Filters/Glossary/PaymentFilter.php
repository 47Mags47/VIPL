<?php

namespace App\Filters\Glossary;

use App\Classes\Filter;

class PaymentFilter extends Filter
{
    protected function search(string $value)
    {
        $value = '%' . $value . '%';

        return $this->builder->where(function ($query) use ($value) {
            return $query
                ->whereLike('code', $value)
                ->orWhereLike('name', $value)
                ->orWhereLike('kbk', $value);
        });
    }
}
