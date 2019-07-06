<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/6/26
 * Time: 15:31
 */

namespace App\Modules\Goods\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Modules\Product\Models\Product;
use App\Modules\Goods\Models\Goods;
use App\Modules\Goods\Models\GoodsSku;
use App\Modules\Goods\Models\SingleProduct;
use App\Modules\Goods\Models\SingleSkuProductSku;

class GoodsTableSeeder extends Seeder
{
    public function run()
    {
        $this->singleSeeder();
        $this->comboSeeder();
    }

    /**
     * single商品数据填充
     */
    public function singleSeeder()
    {
        $products = Product::whereIn('id', [1, 3, 5, 6, 7, 8])->get();
        $category_relations = [
            1 => 2,
            3 => 3,
            5 => 3,
            6 => 6,
            7 => 14,
            8 => 16,
        ];
        foreach ($products as $product) {
            $goods = Goods::create([
                'code' => $product->code,
                'name' => $product->name,
                'type' => Goods::SINGLE,
                'category_id' => $category_relations[$product->id],
            ]);

            SingleProduct::create([
                'goods_id' => $goods->id,
                'product_id' => $product->id,
            ]);

            foreach ($product->skus as $product_sku) {
                $goods_sku = GoodsSku::create([
                    'goods_id' => $goods->id,
                    'code' => $product_sku->code,
                    'lowest_price' => $product_sku->cost_price * 2,
                    'msrp' => $product_sku->cost_price * 4,
                ]);
                SingleSkuProductSku::create([
                    'goods_sku_id' => $goods_sku->id,
                    'product_sku_id' => $product_sku->id,
                ]);
            }
        }
    }

    public function comboSeeder()
    {

    }
}