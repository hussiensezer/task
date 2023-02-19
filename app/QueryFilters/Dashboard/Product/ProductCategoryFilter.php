<?php

namespace App\QueryFilters\Dashboard\Product;

use App\Abstracts\Filter;

class ProductCategoryFilter extends Filter
{
    protected function applyFilter($builder)
    {
        $input = request($this->filterName());
        return $builder->when($input, function ($q) use ($input) {
            $q->whereRaw("products.category_id =  ?", [$input]);
        });
    }
}
