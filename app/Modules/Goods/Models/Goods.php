<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/6/25
 * Time: 20:21
 */

namespace App\Modules\Goods\Models;

use App\Modules\Category\Models\GoodsCategory;
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

    /**
     * 创建商品，连带商品与产品的对应关系
     *
     * @param $attributes
     * @param $product_ids
     * @return static
     */
    public function createWithProductRelation($attributes, $product_ids)
    {
        $goods = parent::create($attributes);

        if ($product_ids) {
            if (self::SINGLE == $goods->type) {
                SingleProduct::create([
                    'goods_id' => $goods->id,
                    'product_id' => $product_ids,
                ]);
            }elseif (Goods::COMBO == $goods->type) {

            }
        }

        return $goods;
    }

    /**
     * 同步商品sku
     *
     * @param $skus
     * @return $this
     */
    public function syncSkus($skus)
    {
        if (!empty($skus) && is_array($skus)) {
            // single商品sku同步
            if (self::SINGLE == $this->type) {
                // 将多余的sku删除掉
                $new_sku_ids = array_filter(array_column($skus, 'goods_sku_id'));
                $unselected_skus = GoodsSku::where('goods_id', $this->id)->whereNotIn('id', $new_sku_ids)->get();
                foreach ($unselected_skus as $unselected_sku) {
                    $unselected_sku->delete();
                    SingleSkuProductSku::where('goods_sku_id', $unselected_sku->id)->delete();
                }

                foreach ($skus as $sku) {
                    if (!empty($sku['goods_sku_id'])) {
                        GoodsSku::find($sku['goods_sku_id'])->update([
                            'code' => $sku['code'],
                            'lowest_price' => $sku['lowest_price'],
                            'msrp' => $sku['msrp'],
                        ]);
                    }else {
                        $product_sku_exist = SingleSkuProductSku::where('product_sku_id', $sku['product_sku_id'])->first();
                        if ($product_sku_exist) {
                            throw new \Exception("Product sku has exists.");
                        }
                        $goods_sku = GoodsSku::create([
                            'goods_id' => $this->id,
                            'code' => $sku['code'],
                            'lowest_price' => $sku['lowest_price'],
                            'msrp' => $sku['msrp'],
                        ]);

                        if ($goods_sku) {
                            SingleSkuProductSku::create([
                                'goods_sku_id' => $goods_sku->id,
                                'product_sku_id' => $sku['product_sku_id'],
                            ]);
                        }
                    }
                }
            }
        }

        return $this;
    }

    /**
     * 关联商品分类
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(GoodsCategory::class);
    }

    /**
     * 关联商品sku
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skus()
    {
        return $this->hasMany(GoodsSku::class);
    }

    /**
     * 读取product_id属性
     *
     * @return mixed
     */
    public function getProductIdAttribute()
    {
        if (self::SINGLE == $this->type) {
            $single_product = SingleProduct::where('goods_id', $this->id)->first();
            if ($single_product) {
                return $single_product->product_id;
            }
        }
    }

    /**
     * 读取产品sku对应的single sku
     *
     * @param $product_sku_id
     * @return mixed bool|object
     */
    public function singleGetSkuByProductSkuId($product_sku_id)
    {
        if (self::SINGLE != $this->type) {
            return false;
        }

        foreach ($this->skus as $sku) {
            if ($product_sku_id == $sku->product_sku_id) {
                return $sku;
            }
        }
    }

    public function getTypeNameAttribute()
    {
        return isset(self::$types[$this->type]) ? self::$types[$this->type] : '';
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