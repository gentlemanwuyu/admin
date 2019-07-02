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
use App\Modules\Goods\Repositories\GoodsRepository;
use App\Modules\Goods\Repositories\GoodsSkuRepository;
use App\Modules\Goods\Repositories\SingleProductRepository;
use App\Modules\Goods\Repositories\SingleSkuProductSkuRepository;

class GoodsService
{
    protected $goodsRepository;
    protected $goodsSkuRepository;
    protected $singleProductRepository;
    protected $singleSkuProductSkuRepository;

    public function __construct(GoodsRepository $goodsRepository,
                                GoodsSkuRepository $goodsSkuRepository,
                                SingleProductRepository $singleProductRepository,
                                SingleSkuProductSkuRepository $singleSkuProductSkuRepository)
    {
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
     * 添加/修改single商品
     *
     * @param $params
     * @return array
     */
    public function createOrUpdateSingle($params)
    {
        try {
            $result = $this->singleProductRepository->findWhere(['product_id' => $params['product_id']])->first();
            if ($result) {
                throw new \Exception("Product exists.");
            }


            DB::beginTransaction();
            $data = [
                'code' => $params['code'],
                'name' => $params['name'],
                'description' => $params['description'],
                'type' => Goods::SINGLE,
                'category_id' => $params['category_id'],
            ];

            $goods = $this->goodsRepository->createWithProductRelation($data, $params['product_id']);

            foreach ($params['skus'] as $product_sku_id => $value) {
                $goods_sku = $this->goodsSkuRepository->create([
                    'goods_id' => $goods->id,
                    'code' => $value['code'],
                    'lowest_price' => $value['lowest_price'],
                    'msrp' => $value['msrp'],
                ]);

                $this->singleSkuProductSkuRepository->create([
                    'goods_sku_id' => $goods_sku->id,
                    'product_sku_id' => $product_sku_id,
                ]);
            }




//            $skus = array_map(function ($item, $key) {
//                $item['product_sku_id'] = $key;
//                return $item;
//            }, $params['skus'], array_keys($params['skus']));
//            $goods->syncSingleSkus($skus);

            DB::commit();
            return ['status' => 'success'];
        }catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}