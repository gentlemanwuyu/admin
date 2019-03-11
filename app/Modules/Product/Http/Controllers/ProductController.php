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
        return view('product::product.list');
    }

    public function createOrUpdateProductPage()
    {
        $categories = $this->categoryService->getCategoryTree('product');

        return view('product::product.create_or_update_product', compact('categories'));
    }

    public function upload()
    {
        return response()->json('https://www.gravatar.com/avatar/e7f04fb1d406bc12f3d8bece06e59d11.jpg?s=80&d=mm&r=g');
    }
}
