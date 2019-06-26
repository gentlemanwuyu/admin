<?php
namespace App\Modules\Goods\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Product\Repositories\ProductRepository;
use App\Modules\Goods\Services\GoodsService;
use App\Modules\Product\Services\ProductService;
use App\Modules\Category\Services\CategoryService;
use App\Modules\Goods\Http\Requests\SingleRequest;

class GoodsController extends Controller
{
    protected $productRepository;
    protected $goodsService;
    protected $productService;
    protected $categoryService;

    public function __construct(ProductRepository $productRepository,
                                GoodsService $goodsService,
                                ProductService $productService,
                                CategoryService $categoryService)
    {
        $this->productRepository = $productRepository;
        $this->goodsService = $goodsService;
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function getList(Request $request)
    {
        return view('goods::goods.list');
    }

    public function chooseProduct(Request $request)
    {
        $products = $this->productService->getProductList($request);

        return view('goods::goods.choose_product', compact('products'));
    }

    public function createOrUpdateSinglePage(Request $request)
    {
        $categories = $this->categoryService->getCategoryTree('goods');
        $product_info = $this->productRepository->find($request->get('product_id'));

        return view('goods::goods.create_or_update_single', compact('product_info', 'categories'));
    }

    public function createOrUpdateSingle(SingleRequest $request)
    {
        return response()->json($this->goodsService->createOrUpdateSingle($request->all()));
    }
}
