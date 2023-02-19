<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\Category\CategoryService;
use App\Services\Dashboard\Product\ProductService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    private  CategoryService $categoryService;
    private  ProductService $productService;
    public function __construct(CategoryService $categoryService,ProductService $productService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }

    public function index():View
    {
        $categories = $this->categoryService->categories();
        $products = $this->productService->products();
        return view('dashboard', compact('categories', 'products'));
    }
}
