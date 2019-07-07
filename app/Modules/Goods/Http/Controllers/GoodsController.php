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
use App\Modules\Goods\Http\Requests\ComboRequest;

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
        $data = compact('categories');
        if ('create' == $request->get('action')) {
            $product_info = $this->productRepository->find($request->get('product_id'));
        }else {
            $goods_info = $this->goodsRepository->find($request->get('goods_id'));
            $product_info = $this->productRepository->find($goods_info->product_id);
            $data['goods_info'] = $goods_info;
        }
        $data['product_info'] = $product_info;

        return view('goods::goods.create_or_update_single', $data);
    }

    public function createOrUpdateComboPage(Request $request)
    {
        $categories = $this->categoryService->getCategoryTree('goods');
        $data = compact('categories');
        if ('create' == $request->get('action')) {
            $products  = array_map(function ($quantity, $product_id) {
                $product = $this->productRepository->find($product_id);
                $product->quantity = $quantity;
                return $product;
            }, $request->get('selected_products'), array_keys($request->get('selected_products')));
        }else {
            $goods_info = $this->goodsRepository->find($request->get('goods_id'));
            $products = $goods_info->getProduct();
            $data['goods_info'] = $goods_info;
        }
        $data['products'] = $products;

        return view('goods::goods.create_or_update_combo', $data);
    }

    public function createOrUpdateSingle(SingleRequest $request)
    {
        return response()->json($this->goodsService->createOrUpdateSingle($request->all()));
    }

    public function getProducts(Request $request)
    {
        return response()->json(['data' => $this->goodsService->getProducts($request->all())]);
    }

    public function upload(Request $request)
    {
        return response()->json($this->goodsService->uploadImageLink($request));
    }

    public function createOrUpdateCombo(ComboRequest $request)
    {
        return response()->json($this->goodsService->createOrUpdateCombo($request->all()));
    }

    public function detail($id)
    {
        $goods_info = $this->goodsRepository->find($id);

        return view('goods::goods.detail', compact('goods_info'));
    }
}
