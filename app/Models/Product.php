<?php

namespace App\Models;

use App\Abstracts\UnicodeModel;
use App\QueryFilters\Dashboard\Product\ProductCategoryFilter;
use App\QueryFilters\Dashboard\Product\ProductNameFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Product extends UnicodeModel
{
    use HasTranslations;
    use HasFactory;
    protected $table = 'products';
    protected $guarded =[];
    public array $translatable = ['name', 'description'];

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class , 'category_id', 'id');
    }

    public static function allProducts()
    {
        return app(Pipeline::class)
            ->send(Product::query())
            ->through([
                ProductCategoryFilter::class,
                ProductNameFilter::class,
            ])->thenReturn();
    }// End AllItems With Filter
}
