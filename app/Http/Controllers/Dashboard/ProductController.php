<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\ProductStoreRequest;
use App\Http\Requests\Dashboard\Product\ProductUpdateRequest;
use App\Models\Product;
use App\Services\Dashboard\Product\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private  ProductService $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function store(ProductStoreRequest $request)
    {
        /*
         * add beginTransaction because we make two operation create and update
         * first create Product
         * then update the product to relate the image by product
         * */
        DB::beginTransaction();
        try {
            $this->productService->setRequestInput($request)->storeProduct();
            DB::commit();
            toastr()->success(__('global.save_success'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }// End Store

    public function update(ProductUpdateRequest $request, Product $product)
    {
        try {
            $this->productService->setModel($product)->setRequestInput($request)->updateProduct();
            toastr()->success(__('global.save_success'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }// End Update

    public function destroy(Product $product)
    {
        try {
            $this->productService->setModel($product)->destroyProduct();
            toastr()->success(__('global.save_success'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }// End Destroy
}
