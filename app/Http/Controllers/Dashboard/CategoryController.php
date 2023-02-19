<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Category\CategoryStoreRequest;
use App\Http\Requests\Dashboard\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\Dashboard\Category\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private  CategoryService $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function store(CategoryStoreRequest $request)
    {
        try {
            $this->categoryService->setRequestInput($request)->storeCategory();
            toastr()->success(__('global.save_success'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }// End Store

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        try {
            $this->categoryService->setModel($category)->setRequestInput($request)->updateCategory();
            toastr()->success(__('global.save_success'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }// End Update

    public function destroy(Category $category)
    {
        try {
            $this->categoryService->setModel($category)->destroyCategory();
            toastr()->success(__('global.save_success'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }// End Destroy
}
