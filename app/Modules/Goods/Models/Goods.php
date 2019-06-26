<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/6/25
 * Time: 20:21
 */

namespace App\Modules\Goods\Models;

use App\Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goods extends Model
{
    use SoftDeletes;

    /**
     * 商品类型
     */
    const SINGLE = 1;
    const COMBO = 2;

    static $types = [
        self::SINGLE => 'single',
        self::COMBO => 'combo',
    ];

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function singleSkus()
    {
        return $this->hasMany(SingleSku::class);
    }

    /**
     * 同步single商品的sku信息
     *
     * @param $skus
     * @return $this
     */
    public function syncSingleSkus($skus)
    {
        // 将product_sku_id作为键
        $skus = array_column($skus, null, 'product_sku_id');

        if ($skus && is_array($skus)) {
            // 所有的产品sku的id
            $product_sku_ids = array_column($this->product->skus->toArray(), 'id');
            // 已经存在的sku
            $exists_sku_ids = [];
            foreach ($this->singleSkus as $singleSku) {
                // 如果不在产品的sku中，将其删除。
                if (!in_array($singleSku->product_sku_id, $product_sku_ids)) {
                    $singleSku->delete();
                    continue;
                }

                $exists_sku_ids[] = $singleSku->product_sku_id;

                if (isset($skus[$singleSku->product_sku_id])) {
                    $singleSku->code = $skus[$singleSku->product_sku_id]['code'];
                    $singleSku->lowest_price = $skus[$singleSku->product_sku_id]['lowest_price'];
                    $singleSku->msrp = $skus[$singleSku->product_sku_id]['msrp'];
                    $singleSku->enabled = 1;
                    $singleSku->save();
                }else {
                    $singleSku->enabled = 0;
                    $singleSku->save();
                }
            }

            $product_skus = array_column($this->product->skus->toArray(), null, 'id');
            // 将缺的产品sku补上
            foreach (array_diff($product_sku_ids, $exists_sku_ids) as $product_sku_id) {
                $data = [
                    'goods_id' => $this->id,
                    'product_sku_id' => $product_sku_id,
                    'code' => isset($product_skus[$product_sku_id]) ? $product_skus[$product_sku_id]['code'] : '',
                ];
                if (isset($skus[$product_sku_id])) {
                    $data['code'] = $skus[$product_sku_id]['code'];
                    $data['lowest_price'] = $skus[$product_sku_id]['lowest_price'];
                    $data['msrp'] = $skus[$product_sku_id]['msrp'];
                    $data['enabled'] = 1;
                }

                SingleSku::create($data);
            }
        }

        return $this;
    }
}