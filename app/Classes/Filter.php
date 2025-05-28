<?php

namespace App\Classes;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class Filter
{
    /**
     * @param string $value - Строка для поиска
     */
    abstract protected function search(string $value);

    protected Builder $builder;

    /**
     * @param FormRequest $request
     */
    public function __construct(protected readonly Request $request) {}

    /**
     * Применение фильтров к запросу
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->request->input('filter') ?? [] as $method => $value) {
            if ($value === null) {
                continue;
            }

            $methodName = Str::camel($method);

            if (method_exists($this, $methodName)) {
                $this->builder = $this->{$methodName}($value);
            }
        }

        return $this->builder;
    }
}
