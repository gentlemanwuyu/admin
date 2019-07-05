<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/6/26
 * Time: 11:01
 */

namespace App\Modules\Goods\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Product\Models\ProductSku;

class GoodsSku extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * 关联商品表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function goods()
    {
        return $this->belongsTo(Goods::class);
    }

    public function getCostPriceAttribute()
    {
        if (Goods::SINGLE == $this->goods->type) {

        }elseif (Goods::COMBO == $this->goods->type) {
            $cost_price = 0.00;
            $combo_sku_product_skus = ComboSkuProductSku::where('goods_sku_id', $this->id)->get();
            foreach ($combo_sku_product_skus as $item) {
                $product_sku = ProductSku::find($item->product_sku_id);
                if ($product_sku) {
                    $cost_price += $product_sku->cost_price;
                }
            }

            return $cost_price;
        }
    }

    /**
     * product_sku_id属性
     *
     * @return mixed
     */
    public function getProductSkuIdAttribute()
    {
        if (Goods::SINGLE == $this->goods->type) {
            $single_sku_product_sku = SingleSkuProductSku::where('goods_sku_id', $this->id)->first();
            if ($single_sku_product_sku) {
                return $single_sku_product_sku->product_sku_id;
            }
        }
    }

    /**
     * 读取combo商品对应产品的skuID
     *
     * @param $product_id
     * @return null
     */
    public function getComboProductSkuId($product_id)
    {
        $combo_sku_product_sku = ComboSkuProductSku::where('goods_sku_id', $this->id)->where('product_id', $product_id)->first();

        return $combo_sku_product_sku ? $combo_sku_product_sku->product_sku_id : null;
    }
}