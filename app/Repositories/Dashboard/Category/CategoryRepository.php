<?php

namespace App\Repositories\Dashboard\Category;

use App\Models\Category;

class CategoryRepository
{
    private object $request;
    private Category $category;


    public function request($request): CategoryRepository
    {
        $this->request = $request;
        return $this;
    }// End Request

    public function model($category): CategoryRepository
    {
        $this->category = $category;
        return $this;
    }// End Model

    public function getCategories()
    {
        return Category::select(['id','name'])->latest()->paginate(20);
    }

    public function store(): void
    {
        Category::create([
            'name' => $this->request->name,
        ]);
    }// End Store


    public function update(): void
    {
        $this->category->update([
            'name' => $this->request->name,
        ]);
    }// End Update

    public function destroy(): void
    {
        $this->category->delete();
    }// End Update
}
