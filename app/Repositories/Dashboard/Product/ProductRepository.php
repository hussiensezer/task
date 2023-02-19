<?php

namespace App\Repositories\Dashboard\Product;

use App\Models\Product;
use App\Traits\MediaTrait;
use Illuminate\Support\Facades\App;

class ProductRepository
{
    use MediaTrait;

    private object $request;
    private Product $product;


    public function request($request): ProductRepository
    {
        $this->request = $request;
        return $this;
    }// End Request

    public function model($category): ProductRepository
    {
        $this->product = $category;
        return $this;
    }// End Model

    public function getProducts()
    {
        $locale = App::getLocale();
        return Product::allProducts()
            ->select(['products.id', 'products.name', 'description', 'image' , 'category_id' , "categories.name->{$locale} AS categoryName"])
            ->join('categories', 'category_id' , '=' , 'categories.id')
            ->latest('categories.created_at')->paginate(20);
    }

    public function store(): void
    {
        $product = Product::create([
            'name' => $this->request->name,
            'description' => $this->request->description,
            'category_id' => $this->request->category
        ]);

        if ($product) {
            $product->update([
                'image' => $this->storeMedia($this->request->image, 'files', 'products')
            ]);
        }
    }// End Store


    public function update(): void
    {
        if ($this->request->hasFile('image')) {
            $this->deleteMedia('files', 'products', $this->product->image);
            $image = $this->storeMedia($this->request->image, 'files', 'products');
        } else {
            $image = $this->product->image;
        }

        $this->product->update([
            'name' => $this->request->name,
            'description' => $this->request->description,
            'category_id' => $this->request->category,
            'image' => $image
        ]);
    }// End Update

    public function destroy(): void
    {
        $this->deleteMedia('files', 'products', $this->product->image);
        $this->product->delete();
    }// End Update
}
