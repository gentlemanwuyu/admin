<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/11
 * Time: 16:09
 */

namespace App\Modules\Product\Database\Seeds;

use App\Modules\Product\Models\Product;
use App\Modules\Product\Models\ProductAttribute;
use App\Modules\Product\Models\ProductSku;
use App\Modules\Product\Models\ProductSkuAttributeValue;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    public function run()
    {
        // 压力表
        $p1 = Product::create([
            'code' => 'xhsylbsus304',
            'name' => '不锈钢304压力表',
            'category_id' => 2,
        ]);
        $p1_a1 = ProductAttribute::create([
            'product_id' => $p1->id,
            'name' => '底座',
        ]);
        $p1_a2 = ProductAttribute::create([
            'product_id' => $p1->id,
            'name' => '量程',
        ]);
        $p1_s1 = ProductSku::create([
            'product_id' => $p1->id,
            'code' => 'xhsylbsus304-4kg',
            'weight' => 68.2,
            'cost_price' => 15.4,
        ]);
        ProductSkuAttributeValue::create([
            'product_id' => $p1->id,
            'sku_id' => $p1_s1->id,
            'attribute_id' => $p1_a1->id,
            'value' => '1/2寸',
        ]);
        ProductSkuAttributeValue::create([
            'product_id' => $p1->id,
            'sku_id' => $p1_s1->id,
            'attribute_id' => $p1_a2->id,
            'value' => '4kg',
        ]);
        $p1_s2 = ProductSku::create([
            'product_id' => $p1->id,
            'code' => 'xhsylbsus304-7kg',
            'weight' => 68.5,
            'cost_price' => 15.8,
        ]);
        ProductSkuAttributeValue::create([
            'product_id' => $p1->id,
            'sku_id' => $p1_s2->id,
            'attribute_id' => $p1_a1->id,
            'value' => '1寸',
        ]);
        ProductSkuAttributeValue::create([
            'product_id' => $p1->id,
            'sku_id' => $p1_s2->id,
            'attribute_id' => $p1_a2->id,
            'value' => '7kg',
        ]);
        $p1_s3 = ProductSku::create([
            'product_id' => $p1->id,
            'code' => 'xhsylbsus304-10kg',
            'weight' => 70.8,
            'cost_price' => 16.8,
        ]);
        ProductSkuAttributeValue::create([
            'product_id' => $p1->id,
            'sku_id' => $p1_s3->id,
            'attribute_id' => $p1_a1->id,
            'value' => '1/4寸',
        ]);
        ProductSkuAttributeValue::create([
            'product_id' => $p1->id,
            'sku_id' => $p1_s3->id,
            'attribute_id' => $p1_a2->id,
            'value' => '10kg',
        ]);

        // 滚轮片
        $p2 = Product::create([
            'code' => 'xhslppp124',
            'name' => 'pp滚轮片124',
            'category_id' => 11,
        ]);
        $p2_a1 = ProductAttribute::create([
            'product_id' => $p2->id,
            'name' => '外径',
        ]);
        $p2_a2 = ProductAttribute::create([
            'product_id' => $p2->id,
            'name' => '内孔',
        ]);
        $p2_a3 = ProductAttribute::create([
            'product_id' => $p2->id,
            'name' => '有效长度',
        ]);
        $p2_a4 = ProductAttribute::create([
            'product_id' => $p2->id,
            'name' => '总长',
        ]);
        $p2_s1 = ProductSku::create([
            'product_id' => $p2->id,
            'code' => 'xhslppp124a',
            'weight' => 25,
            'cost_price' => 0.2,
        ]);
        ProductSkuAttributeValue::create([
            'product_id' => $p2->id,
            'sku_id' => $p2_s1->id,
            'attribute_id' => $p2_a1->id,
            'value' => '40cm',
        ]);
        ProductSkuAttributeValue::create([
            'product_id' => $p2->id,
            'sku_id' => $p2_s1->id,
            'attribute_id' => $p2_a2->id,
            'value' => '8cm',
        ]);
        ProductSkuAttributeValue::create([
            'product_id' => $p2->id,
            'sku_id' => $p2_s1->id,
            'attribute_id' => $p2_a3->id,
            'value' => '20cm',
        ]);
        ProductSkuAttributeValue::create([
            'product_id' => $p2->id,
            'sku_id' => $p2_s1->id,
            'attribute_id' => $p2_a4->id,
            'value' => '30cm',
        ]);
        $p2_s2 = ProductSku::create([
            'product_id' => $p2->id,
            'code' => 'xhslppp124b',
            'weight' => 25,
            'cost_price' => 0.2,
        ]);
        ProductSkuAttributeValue::create([
            'product_id' => $p2->id,
            'sku_id' => $p2_s2->id,
            'attribute_id' => $p2_a1->id,
            'value' => '40cm',
        ]);
        ProductSkuAttributeValue::create([
            'product_id' => $p2->id,
            'sku_id' => $p2_s2->id,
            'attribute_id' => $p2_a2->id,
            'value' => '10cm',
        ]);
        ProductSkuAttributeValue::create([
            'product_id' => $p2->id,
            'sku_id' => $p2_s2->id,
            'attribute_id' => $p2_a3->id,
            'value' => '20cm',
        ]);
        ProductSkuAttributeValue::create([
            'product_id' => $p2->id,
            'sku_id' => $p2_s2->id,
            'attribute_id' => $p2_a4->id,
            'value' => '30cm',
        ]);
        $p2_s3 = ProductSku::create([
            'product_id' => $p2->id,
            'code' => 'xhslppp124c',
            'weight' => 25,
            'cost_price' => 0.2,
        ]);
        ProductSkuAttributeValue::create([
            'product_id' => $p2->id,
            'sku_id' => $p2_s3->id,
            'attribute_id' => $p2_a1->id,
            'value' => '40cm',
        ]);
        ProductSkuAttributeValue::create([
            'product_id' => $p2->id,
            'sku_id' => $p2_s3->id,
            'attribute_id' => $p2_a2->id,
            'value' => '12cm',
        ]);
        ProductSkuAttributeValue::create([
            'product_id' => $p2->id,
            'sku_id' => $p2_s3->id,
            'attribute_id' => $p2_a3->id,
            'value' => '20cm',
        ]);
        ProductSkuAttributeValue::create([
            'product_id' => $p2->id,
            'sku_id' => $p2_s3->id,
            'attribute_id' => $p2_a4->id,
            'value' => '30cm',
        ]);
    }
}