<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/6/26
 * Time: 10:57
 */

namespace App\Modules\Goods\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Modules\Goods\Models\Goods;
use App\Modules\Goods\Models\SingleProduct;

class GoodsRepository extends BaseRepository
{
    public function model()
    {
        return Goods::class;
    }

    public function createWithProductRelation($attributes, $product_ids)
    {
        $goods = parent::create($attributes);

        if ($product_ids) {
            if (Goods::SINGLE == $goods->type) {
                SingleProduct::create([
                    'goods_id' => $goods->id,
                    'product_id' => $product_ids,
                ]);
            }elseif (Goods::COMBO == $goods->type) {

            }
        }

        return $goods;
    }
}