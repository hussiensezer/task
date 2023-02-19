<?php

namespace App\QueryFilters\Dashboard\Product;

use App\Abstracts\Filter;

class ProductNameFilter extends Filter
{

    protected function applyFilter($builder)
    {
        $input = request($this->filterName());
        return $builder->when($input, function ($q) use ($input) {
            $q->whereRaw("products.name LIKE ?", ["%{$input}%"]);
        });
    }
}
