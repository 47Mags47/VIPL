<?php

namespace App\Filters\Payment;

use App\Classes\Filter;

class RecipientFilter extends Filter
{
    protected function search(string $value)
    {
        $value = '%' . $value . '%';

        return $this->builder->where(function ($query) use ($value) {
            return $query
                ->whereLike('first_name', $value)
                ->orWhereLike('last_name', $value)
                ->orWhereLike('middle_name', $value)
                ->orWhereLike('snils', $value)
                ->orWhereLike('account', $value);
        });
    }
}
