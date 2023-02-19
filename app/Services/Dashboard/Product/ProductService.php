<?php

namespace App\Services\Dashboard\Product;

use App\Models\Product;
use App\Repositories\Dashboard\Product\ProductRepository;

class ProductService
{
    public ProductRepository $productRepository;
    private object $requestInput;

    private Product $model;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function setRequestInput(object $request) :ProductService
    {
        $this->requestInput = $request;
        return $this;
    }// End SetRequestInput

    public function setModel($model):ProductService
    {
        $this->model = $model;
        return $this;
    }

    public function storeProduct(): void
    {
        $this->productRepository->request($this->requestInput)->store();
    }// End Store Category

    public function updateProduct(): void
    {
        $this->productRepository->model($this->model)->request($this->requestInput)->update();
    }// End UpdateCategory

    public function destroyProduct(): void
    {
        $this->productRepository->model($this->model)->destroy();
    }// End DestroyCategory

    public function products()
    {
        return $this->productRepository->getProducts();
    }// End Categories
}
