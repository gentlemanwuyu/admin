<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/23
 * Time: 14:28
 */

namespace App\Modules\Goods\Services;

use Illuminate\Support\Facades\DB;
use App\Modules\Goods\Models\Goods;
use App\Modules\Product\Repositories\ProductRepository;
use App\Modules\Goods\Repositories\GoodsRepository;
use App\Modules\Goods\Repositories\GoodsSkuRepository;
use App\Modules\Goods\Repositories\SingleProductRepository;
use App\Modules\Goods\Repositories\SingleSkuProductSkuRepository;
use App\Modules\Product\Repositories\Criteria\Product\IdNotIn;

class GoodsService
{
    protected $productRepository;
    protected $goodsRepository;
    protected $goodsSkuRepository;
    protected $singleProductRepository;
    protected $singleSkuProductSkuRepository;

    public function __construct(ProductRepository $productRepository,
                                GoodsRepository $goodsRepository,
                                GoodsSkuRepository $goodsSkuRepository,
                                SingleProductRepository $singleProductRepository,
                                SingleSkuProductSkuRepository $singleSkuProductSkuRepository)
    {
        $this->productRepository = $productRepository;
        $this->goodsRepository = $goodsRepository;
        $this->goodsSkuRepository = $goodsSkuRepository;
        $this->singleProductRepository = $singleProductRepository;
        $this->singleSkuProductSkuRepository = $singleSkuProductSkuRepository;
    }

    public function getList($params)
    {
        return $this->goodsRepository->paginate();
    }

    /**
     * 读取所有产品用于创建商品用
     *
     * @param $params
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getProducts($params)
    {
        if (isset($params['type']) && Goods::SINGLE == $params['type']) {
            $product_ids = array_column($this->singleProductRepository->all()->toArray(), 'product_id');
            $this->productRepository->pushCriteria(new IdNotIn($product_ids));
        }

        return $this->productRepository->all()->map(function ($product) {
            $item = [];
            $item['id'] = $product->id;
            $item['code'] = $product->code;
            $item['name'] = $product->name;
            $item['category'] = $product->category->display_name;
            $item['skus'] = $product->skus;
            return $item;
        });


    }

    /**
     * 添加/修改single商品
     *
     * @param $params
     * @return array
     */
    public function createOrUpdateSingle($params)
    {
        try {
            // 如果是新建single商品，首先判断是否已创建过
            if ('create' == $params['action']) {
                $result = $this->singleProductRepository->findWhere(['product_id' => $params['product_id']])->first();
                if ($result) {
                    throw new \Exception("Product exists.");
                }
            }

            DB::beginTransaction();
            $data = [
                'code' => $params['code'],
                'name' => $params['name'],
                'description' => $params['description'],
                'category_id' => $params['category_id'],
            ];

            if ('create' == $params['action']) {
                $data['type'] = Goods::SINGLE;
                $goods = $this->goodsRepository->createWithProductRelation($data, $params['product_id']);
            }else {
                $goods = $this->goodsRepository->update($data, $params['goods_id']);
            }

            $skus = array_map(function ($item, $key) {
                $item['product_sku_id'] = $key;
                return $item;
            }, $params['skus'], array_keys($params['skus']));

            $goods->syncSkus($skus);

            DB::commit();
            return ['status' => 'success'];
        }catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}