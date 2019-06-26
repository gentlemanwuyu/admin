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
use App\Modules\Goods\Repositories\SingleSkuRepository;

class GoodsService
{
    protected $goodsRepository;
    protected $singleSkuRepository;

    public function __construct(GoodsRepository $goodsRepository, SingleSkuRepository $singleSkuRepository)
    {
        $this->goodsRepository = $goodsRepository;
        $this->singleSkuRepository = $singleSkuRepository;
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
            // TODO: 判断产品ID是否已创建过商品
            DB::beginTransaction();
            $data = [
                'code' => $params['code'],
                'name' => $params['name'],
                'description' => $params['description'],
                'type' => Goods::SINGLE,
                'category_id' => $params['category_id'],
                'product_id' => $params['product_id'],
            ];

            $goods = $this->goodsRepository->create($data);
            $skus = array_map(function ($item, $key) {
                $item['product_sku_id'] = $key;
                return $item;
            }, $params['skus'], array_keys($params['skus']));
            $goods->syncSingleSkus($skus);

            DB::commit();
            return ['status' => 'success'];
        }catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}