<?php
namespace App\Modules\Product\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Product\Services\ProductService;
use App\Modules\Category\Services\CategoryService;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
	}

    public function getList()
    {
        $products = $this->productService->getProductList();

        return view('product::product.list', compact('products'));
    }

    public function createOrUpdateProductPage()
    {
        $categories = $this->categoryService->getCategoryTree('product');

        return view('product::product.create_or_update_product', compact('categories'));
    }

    public function upload(Request $request)
    {
        return response()->json($this->productService->uploadImageLink($request));
    }
}
