<?php

namespace App\Filters\Glossary;

use App\Classes\Filter;

class EventFilter extends Filter
{
    protected function search(string $value)
    {
        $like = '%' . $value . '%';

        return $this->builder
            ->Where('date', $value)
            ->orWhere(fn($query) => $query->whereHas(
                'payment',
                fn($payment_query) => $payment_query
                    ->whereLike('code', $like)
                    ->orWhereLike('name', $like)
            ))
            ->orWhere(fn($query) => $query->whereHas(
                'payment.law',
                fn($payment_query) => $payment_query
                    ->whereLike('name', $like)
            ));
    }
}
