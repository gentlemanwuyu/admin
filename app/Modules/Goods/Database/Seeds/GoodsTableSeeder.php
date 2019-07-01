<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/6/26
 * Time: 15:31
 */

namespace App\Modules\Goods\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Modules\Goods\Models\Goods;
use App\Modules\Goods\Models\SingleSku;
use App\Modules\Product\Models\Product;

class GoodsTableSeeder extends Seeder
{
    public function run()
    {
//        $this->singleSeeder();
    }

    /**
     * single商品数据填充
     */
    public function singleSeeder()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $goods = Goods::create([
                'code' => $product->code,
                'name' => $product->name,
                'type' => Goods::SINGLE,
                'category_id' => $product->category_id,
                'product_id' => $product->id,
            ]);

            foreach ($product->skus as $product_sku) {
                SingleSku::create([
                    'goods_id' => $goods->id,
                    'product_sku_id' => $product_sku->id,
                    'code' => $product_sku->code,
                    'lowest_price' => $product_sku->cost_price * 2,
                    'msrp' => $product_sku->cost_price * 4,
                    'enabled' => mt_rand(0, 1),
                ]);
            }
        }
    }
}