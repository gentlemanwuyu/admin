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

    /**
     * 计算商品sku的成本价
     *
     * @return float|null
     */
    public function getCostPriceAttribute()
    {
        if (Goods::SINGLE == $this->goods->type) {
            $single_sku_product_sku = SingleSkuProductSku::where('goods_sku_id', $this->id)->first();
            if ($single_sku_product_sku) {
                $product_sku = ProductSku::find($single_sku_product_sku['product_sku_id']);
                return $product_sku ? $product_sku->cost_price : null;
            }
        }elseif (Goods::COMBO == $this->goods->type) {
            $products = $this->goods->getProduct();
            $cost_price = 0.00;
            $combo_sku_product_skus = ComboSkuProductSku::where('goods_sku_id', $this->id)->get();
            foreach ($combo_sku_product_skus as $item) {
                $product_sku = ProductSku::find($item->product_sku_id);
                if ($product_sku) {
                    $product = $products[$item->product_id];
                    $cost_price += $product_sku->cost_price * $product->quantity;
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
        }elseif (Goods::COMBO == $this->goods->type) {
            $combo_sku_product_skus = ComboSkuProductSku::where('goods_sku_id', $this->id)->get()->toArray();

            return array_column($combo_sku_product_skus, 'product_sku_id', 'product_id');
        }
    }

    public function getProductSku()
    {
        if (Goods::SINGLE == $this->goods->type) {
            return ProductSku::find($this->product_sku_id);
        }elseif (Goods::COMBO == $this->goods->type) {
            $product_skus = [];
            $product_id_quantities = $this->goods->product_id;
            foreach ($this->product_sku_id as $product_id => $product_sku_id) {
                $product_sku = ProductSku::find($product_sku_id);
                $product_sku->quantity = isset($product_id_quantities[$product_id]) ? $product_id_quantities[$product_id] : 0;
                $product_skus[$product_id] = $product_sku;
            }

            return $product_skus;
        }
    }
}