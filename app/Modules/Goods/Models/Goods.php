<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/6/25
 * Time: 20:21
 */

namespace App\Modules\Goods\Models;

use App\Modules\Category\Models\GoodsCategory;
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

    /**
     * 创建商品，连带商品与产品的对应关系
     *
     * @param $attributes
     * @param $products
     * @return static
     */
    public function createWithProductRelation($attributes, $products)
    {
        $goods = parent::create($attributes);

        if ($products) {
            if (self::SINGLE == $goods->type) {
                SingleProduct::create([
                    'goods_id' => $goods->id,
                    'product_id' => $products,
                ]);
            }elseif (Goods::COMBO == $goods->type) {
                foreach ($products as $product_id => $quantity) {
                    ComboProduct::create([
                        'goods_id' => $goods->id,
                        'product_id' => $product_id,
                        'quantity' => $quantity,
                    ]);
                }
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
            }elseif (self::COMBO == $this->type) {
                // 将多余的sku删掉
                $new_sku_ids = array_column($skus, 'goods_sku_id');
                $invalid_skus = GoodsSku::where('goods_id', $this->id)->whereNotIn('id', $new_sku_ids)->get();
                foreach ($invalid_skus as $invalid_sku) {
                    $invalid_sku->delete();
                    ComboSkuProductSku::where('goods_sku_id', $invalid_sku->id)->delete();
                }

                foreach ($skus as $sku) {
                    $goods_sku = GoodsSku::find($sku['goods_sku_id']);
                    if (!$goods_sku) {
                        $goods_sku = GoodsSku::create([
                            'goods_id' => $this->id,
                            'code' => $sku['code'],
                            'lowest_price' => $sku['lowest_price'],
                            'msrp' => $sku['msrp'],
                        ]);
                    }else {
                        $goods_sku->update([
                            'code' => $sku['code'],
                            'lowest_price' => $sku['lowest_price'],
                            'msrp' => $sku['msrp'],
                        ]);
                    }

                    if ($goods_sku) {
                        foreach ($sku['selected_product_skus'] as $product_id => $product_sku_id) {
                            ComboSkuProductSku::updateOrCreate([
                                'goods_sku_id' => $goods_sku->id,
                                'product_id' => $product_id,
                            ], [
                                'goods_sku_id' => $goods_sku->id,
                                'product_id' => $product_id,
                                'product_sku_id' => $product_sku_id,
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
        }elseif (self::COMBO == $this->type) {
            $combo_products = ComboProduct::where('goods_id', $this->id)->get()->toArray();
            return array_column($combo_products, 'quantity', 'product_id');
        }
    }

    /**
     * 读取combo的关联产品
     *
     * @return array
     */
    public function getProductsOfCombo()
    {
        $products = [];
        foreach ($this->product_id as $product_id => $quantity) {
            $product = Product::find($product_id);
            if ($product) {
                $product->quantity = $quantity;
                $products[$product_id] = $product;
            }
        }

        return $products;
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
}