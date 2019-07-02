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
}