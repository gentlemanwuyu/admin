<?php
namespace App\Modules\Product\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Product\Repositories\ProductRepository;
use App\Modules\Category\Repositories\CategoryRepository;
use App\Modules\Product\Services\ProductService;
use App\Modules\Product\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;
    protected $productService;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository, ProductService $productService)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productService = $productService;
	}

    public function getList(Request $request)
    {
        $products = $this->productService->getProductList($request);

        return view('product::product.list', compact('products'));
    }

    public function createOrUpdateProductPage(Request $request)
    {
        $categories = $this->categoryRepository->findWhere(['type' => 1, 'parent_id' => 0]);
        $data = compact('categories');

        if ('update' == $request->get('action')) {
            $product_info = $this->productRepository->find($request->get('product_id'));
            $data = array_merge($data, compact('product_info'));
        }

        return view('product::product.create_or_update_product', $data);
    }

    public function setInventoryPage(Request $request)
    {
        $product_info = $this->productRepository->find($request->get('product_id'));

        return view('product::product.set_inventory', compact('product_info'));
    }

    public function setInventory(Request $request)
    {
        return response()->json($this->productService->setInventory($request));
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

    public function detail($id)
    {
        $product_info = $this->productRepository->find($id);

        return view('product::product.detail', compact('product_info'));
    }
}
