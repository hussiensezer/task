<?php

namespace App\Services\Dashboard\Category;

use App\Models\Category;
use App\Repositories\Dashboard\Category\CategoryRepository;

class CategoryService
{
    public CategoryRepository $categoryRepository;
    private object $requestInput;

    private Category $model;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function setRequestInput(object $request) :CategoryService
    {
        $this->requestInput = $request;
        return $this;
    }// End SetRequestInput

    public function setModel($model):CategoryService
    {
        $this->model = $model;
        return $this;
    }

    public function storeCategory(): void
    {
         $this->categoryRepository->request($this->requestInput)->store();
    }// End Store Category

    public function updateCategory(): void
    {
        $this->categoryRepository->model($this->model)->request($this->requestInput)->update();
    }// End UpdateCategory

    public function destroyCategory(): void
    {
        $this->categoryRepository->model($this->model)->destroy();
    }// End DestroyCategory

    public function categories()
    {
      return $this->categoryRepository->getCategories();
    }// End Categories
}
