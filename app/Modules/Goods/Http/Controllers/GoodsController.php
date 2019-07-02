<?php
namespace App\Modules\Goods\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Goods\Repositories\GoodsRepository;
use App\Modules\Product\Repositories\ProductRepository;
use App\Modules\Goods\Services\GoodsService;
use App\Modules\Category\Services\CategoryService;
use App\Modules\Goods\Http\Requests\SingleRequest;

class GoodsController extends Controller
{
    protected $goodsRepository;
    protected $productRepository;
    protected $goodsService;
    protected $categoryService;

    public function __construct(GoodsRepository $goodsRepository,
                                ProductRepository $productRepository,
                                GoodsService $goodsService,
                                CategoryService $categoryService)
    {
        $this->goodsRepository = $goodsRepository;
        $this->productRepository = $productRepository;
        $this->goodsService = $goodsService;
        $this->categoryService = $categoryService;
    }

    public function getList(Request $request)
    {
        $goods = $this->goodsService->getList($request->all());

        return view('goods::goods.list', compact('goods'));
    }

    public function chooseSingleProductPage(Request $request)
    {
        return view('goods::goods.choose_single_product');
    }

    public function chooseComboProductPage(Request $request)
    {
        return view('goods::goods.choose_combo_product');
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
        return response()->json(['data' => $this->goodsService->getProducts($request->all())]);
    }
}
