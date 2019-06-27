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

    public function chooseProductPage(Request $request)
    {
        return view('goods::goods.choose_product');
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

    public function getProducts(Request $request)
    {
        $data = $this->productRepository->all()->map(function ($product) {
            $item = [];
            $item['id'] = $product->id;
            $item['code'] = $product->code;
            $item['name'] = $product->name;
            $item['category'] = $product->category->display_name;
            $item['skus'] = $product->skus;
            return $item;
        });

        return response()->json(['data' => $data]);
    }
}
