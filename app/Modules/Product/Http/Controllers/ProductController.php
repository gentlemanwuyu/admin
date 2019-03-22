<?php
namespace App\Modules\Product\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Product\Services\ProductService;
use App\Modules\Category\Services\CategoryService;
use App\Modules\Product\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
	}

    public function getList(Request $request)
    {
        $products = $this->productService->getProductList($request);

        return view('product::product.list', compact('products'));
    }

    public function createOrUpdateProductPage(Request $request)
    {
        $categories = $this->categoryService->getCategoryTree('product');
        $data = compact('categories');

        if ('update' == $request->get('action')) {
            $product_info = $this->productService->getProduct($request->get('product_id'));
            $data = array_merge($data, compact('product_info'));
        }

        return view('product::product.create_or_update_product', $data);
    }

    public function createOrUpdateProduct(ProductRequest $request)
    {
        return response()->json($this->productService->createOrUpdateProduct($request));
    }

    public function upload(Request $request)
    {
        return response()->json($this->productService->uploadImageLink($request));
    }

    public function deleteProduct(Request $request)
    {
        return response()->json($this->productService->deleteProduct($request));
    }

    public function productDetail($id)
    {
        $product_info = $this->productService->getProduct($id);

        return view('product::product.detail', compact('product_info'));
    }
}
