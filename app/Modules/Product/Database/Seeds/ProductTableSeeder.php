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
        $p1 = Product::create(['code' => 'xhsylbsus304001', 'name' => '不锈钢径向压力表', 'category_id' => 2,]);
        $p1_a1 = ProductAttribute::create(['product_id' => $p1->id, 'name' => '底座', 'is_required' => 1,]);
        $p1_a2 = ProductAttribute::create(['product_id' => $p1->id, 'name' => '量程', 'is_required' => 1,]);
        $p1_s1 = ProductSku::create(['product_id' => $p1->id, 'code' => 'xhsylbsus304001-4kg', 'weight' => 68.2, 'cost_price' => 15.4,]);
        ProductSkuAttributeValue::create(['product_id' => $p1->id, 'sku_id' => $p1_s1->id, 'attribute_id' => $p1_a1->id, 'value' => '1/2寸',]);
        ProductSkuAttributeValue::create(['product_id' => $p1->id, 'sku_id' => $p1_s1->id, 'attribute_id' => $p1_a2->id, 'value' => '4kg',]);
        $p1_s2 = ProductSku::create(['product_id' => $p1->id, 'code' => 'xhsylbsus304001-7kg', 'weight' => 68.5, 'cost_price' => 15.8,]);
        ProductSkuAttributeValue::create(['product_id' => $p1->id, 'sku_id' => $p1_s2->id, 'attribute_id' => $p1_a1->id, 'value' => '1寸',]);
        ProductSkuAttributeValue::create(['product_id' => $p1->id, 'sku_id' => $p1_s2->id, 'attribute_id' => $p1_a2->id, 'value' => '7kg',]);
        $p1_s3 = ProductSku::create(['product_id' => $p1->id, 'code' => 'xhsylbsus304001-10kg', 'weight' => 70.8, 'cost_price' => 16.8,]);
        ProductSkuAttributeValue::create(['product_id' => $p1->id, 'sku_id' => $p1_s3->id, 'attribute_id' => $p1_a1->id, 'value' => '1/4寸',]);
        ProductSkuAttributeValue::create(['product_id' => $p1->id, 'sku_id' => $p1_s3->id, 'attribute_id' => $p1_a2->id, 'value' => '10kg',]);

        $p2 = Product::create(['code' => 'xhsylbsus304002', 'name' => '不锈钢轴向压力表', 'category_id' => 2,]);
        $p2_a1 = ProductAttribute::create(['product_id' => $p2->id, 'name' => '底座', 'is_required' => 1,]);
        $p2_a2 = ProductAttribute::create(['product_id' => $p2->id, 'name' => '量程', 'is_required' => 1,]);
        $p2_s1 = ProductSku::create(['product_id' => $p2->id, 'code' => 'xhsylbsus304002-4kg', 'weight' => 68.2, 'cost_price' => 15.4,]);
        ProductSkuAttributeValue::create(['product_id' => $p2->id, 'sku_id' => $p2_s1->id, 'attribute_id' => $p2_a1->id, 'value' => '1/2寸',]);
        ProductSkuAttributeValue::create(['product_id' => $p2->id, 'sku_id' => $p2_s1->id, 'attribute_id' => $p2_a2->id, 'value' => '4kg',]);
        $p2_s2 = ProductSku::create(['product_id' => $p2->id, 'code' => 'xhsylbsus304002-7kg', 'weight' => 68.5, 'cost_price' => 15.8,]);
        ProductSkuAttributeValue::create(['product_id' => $p2->id, 'sku_id' => $p2_s2->id, 'attribute_id' => $p2_a1->id, 'value' => '1寸',]);
        ProductSkuAttributeValue::create(['product_id' => $p2->id, 'sku_id' => $p2_s2->id, 'attribute_id' => $p2_a2->id, 'value' => '7kg',]);
        $p2_s3 = ProductSku::create(['product_id' => $p2->id, 'code' => 'xhsylbsus304002-10kg', 'weight' => 70.8, 'cost_price' => 16.8,]);
        ProductSkuAttributeValue::create(['product_id' => $p2->id, 'sku_id' => $p2_s3->id, 'attribute_id' => $p2_a1->id, 'value' => '1/4寸',]);
        ProductSkuAttributeValue::create(['product_id' => $p2->id, 'sku_id' => $p2_s3->id, 'attribute_id' => $p2_a2->id, 'value' => '10kg',]);

        $p3 = Product::create(['code' => 'xhsylbpp001', 'name' => 'PP单面隔膜压力表', 'category_id' => 3,]);
        $p3_a1 = ProductAttribute::create(['product_id' => $p3->id, 'name' => '底座', 'is_required' => 1,]);
        $p3_a2 = ProductAttribute::create(['product_id' => $p3->id, 'name' => '量程', 'is_required' => 1,]);
        $p3_s1 = ProductSku::create(['product_id' => $p3->id, 'code' => 'xhsylbpp001-4kg', 'weight' => 68.2, 'cost_price' => 28.4,]);
        ProductSkuAttributeValue::create(['product_id' => $p3->id, 'sku_id' => $p3_s1->id, 'attribute_id' => $p3_a1->id, 'value' => '1/2寸',]);
        ProductSkuAttributeValue::create(['product_id' => $p3->id, 'sku_id' => $p3_s1->id, 'attribute_id' => $p3_a2->id, 'value' => '4kg',]);
        $p3_s2 = ProductSku::create(['product_id' => $p3->id, 'code' => 'xhsylbpp001-7kg', 'weight' => 72.5, 'cost_price' => 30.8,]);
        ProductSkuAttributeValue::create(['product_id' => $p3->id, 'sku_id' => $p3_s2->id, 'attribute_id' => $p3_a1->id, 'value' => '1寸',]);
        ProductSkuAttributeValue::create(['product_id' => $p3->id, 'sku_id' => $p3_s2->id, 'attribute_id' => $p3_a2->id, 'value' => '7kg',]);
        $p3_s3 = ProductSku::create(['product_id' => $p3->id, 'code' => 'xhsylbpp001-10kg', 'weight' => 78.8, 'cost_price' => 132.8,]);
        ProductSkuAttributeValue::create(['product_id' => $p3->id, 'sku_id' => $p3_s3->id, 'attribute_id' => $p3_a1->id, 'value' => '1/4寸',]);
        ProductSkuAttributeValue::create(['product_id' => $p3->id, 'sku_id' => $p3_s3->id, 'attribute_id' => $p3_a2->id, 'value' => '10kg',]);

        $p4 = Product::create(['code' => 'xhsylbpp002', 'name' => 'PP双面隔膜压力表', 'category_id' => 3,]);
        $p4_a1 = ProductAttribute::create(['product_id' => $p4->id, 'name' => '底座', 'is_required' => 1,]);
        $p4_a2 = ProductAttribute::create(['product_id' => $p4->id, 'name' => '量程', 'is_required' => 1,]);
        $p4_s1 = ProductSku::create(['product_id' => $p4->id, 'code' => 'xhsylbpp002-4kg', 'weight' => 78.2, 'cost_price' => 36.4,]);
        ProductSkuAttributeValue::create(['product_id' => $p4->id, 'sku_id' => $p4_s1->id, 'attribute_id' => $p4_a1->id, 'value' => '1/2寸',]);
        ProductSkuAttributeValue::create(['product_id' => $p4->id, 'sku_id' => $p4_s1->id, 'attribute_id' => $p4_a2->id, 'value' => '4kg',]);
        $p4_s2 = ProductSku::create(['product_id' => $p4->id, 'code' => 'xhsylbpp002-7kg', 'weight' => 88.5, 'cost_price' => 36.8,]);
        ProductSkuAttributeValue::create(['product_id' => $p4->id, 'sku_id' => $p4_s2->id, 'attribute_id' => $p4_a1->id, 'value' => '1寸',]);
        ProductSkuAttributeValue::create(['product_id' => $p4->id, 'sku_id' => $p4_s2->id, 'attribute_id' => $p4_a2->id, 'value' => '7kg',]);
        $p4_s3 = ProductSku::create(['product_id' => $p4->id, 'code' => 'xhsylbpp002-10kg', 'weight' => 93.8, 'cost_price' => 38.8,]);
        ProductSkuAttributeValue::create(['product_id' => $p4->id, 'sku_id' => $p4_s3->id, 'attribute_id' => $p4_a1->id, 'value' => '1/4寸',]);
        ProductSkuAttributeValue::create(['product_id' => $p4->id, 'sku_id' => $p4_s3->id, 'attribute_id' => $p4_a2->id, 'value' => '10kg',]);

        $p5 = Product::create(['code' => 'xhsylbpp002', 'name' => '一体成型压力表', 'category_id' => 3,]);
        $p5_a1 = ProductAttribute::create(['product_id' => $p5->id, 'name' => '底座', 'is_required' => 1,]);
        $p5_a2 = ProductAttribute::create(['product_id' => $p5->id, 'name' => '量程', 'is_required' => 1,]);
        $p5_s1 = ProductSku::create(['product_id' => $p5->id, 'code' => 'xhsylbpp002-4kg', 'weight' => 78.2, 'cost_price' => 36.4,]);
        ProductSkuAttributeValue::create(['product_id' => $p5->id, 'sku_id' => $p5_s1->id, 'attribute_id' => $p5_a1->id, 'value' => '1/2寸',]);
        ProductSkuAttributeValue::create(['product_id' => $p5->id, 'sku_id' => $p5_s1->id, 'attribute_id' => $p5_a2->id, 'value' => '4kg',]);
        $p5_s2 = ProductSku::create(['product_id' => $p5->id, 'code' => 'xhsylbpp002-7kg', 'weight' => 88.5, 'cost_price' => 36.8,]);
        ProductSkuAttributeValue::create(['product_id' => $p5->id, 'sku_id' => $p5_s2->id, 'attribute_id' => $p5_a1->id, 'value' => '1寸',]);
        ProductSkuAttributeValue::create(['product_id' => $p5->id, 'sku_id' => $p5_s2->id, 'attribute_id' => $p5_a2->id, 'value' => '7kg',]);
        $p5_s3 = ProductSku::create(['product_id' => $p5->id, 'code' => 'xhsylbpp002-10kg', 'weight' => 93.8, 'cost_price' => 38.8,]);
        ProductSkuAttributeValue::create(['product_id' => $p5->id, 'sku_id' => $p5_s3->id, 'attribute_id' => $p5_a1->id, 'value' => '1/4寸',]);
        ProductSkuAttributeValue::create(['product_id' => $p5->id, 'sku_id' => $p5_s3->id, 'attribute_id' => $p5_a2->id, 'value' => '10kg',]);



        //液位开关
        $s1 = Product::create(['code' => 'xhsywkgpp011', 'name' => '立式液位开关011', 'category_id' => 6,]);
        $s1_a1 = ProductAttribute::create(['product_id' => $s1->id, 'name' => '外径', 'is_required' => 1,]);
        $s1_a2 = ProductAttribute::create(['product_id' => $s1->id, 'name' => '线长', 'is_required' => 1,]);
        $s1_s1 = ProductSku::create(['product_id' => $s1->id, 'code' => 'xhsywkgpp011-5m', 'weight' => 230.2, 'cost_price' => 10.4,]);
        ProductSkuAttributeValue::create(['product_id' => $s1->id, 'sku_id' => $s1_s1->id, 'attribute_id' => $s1_a1->id, 'value' => '1/2寸',]);
        ProductSkuAttributeValue::create(['product_id' => $s1->id, 'sku_id' => $s1_s1->id, 'attribute_id' => $s1_a2->id, 'value' => '4kg',]);
        $s1_s2 = ProductSku::create(['product_id' => $s1->id, 'code' => 'xhsywkgpp011-10m', 'weight' => 230.5, 'cost_price' => 11.8,]);
        ProductSkuAttributeValue::create(['product_id' => $s1->id, 'sku_id' => $s1_s2->id, 'attribute_id' => $s1_a1->id, 'value' => '1寸',]);
        ProductSkuAttributeValue::create(['product_id' => $s1->id, 'sku_id' => $s1_s2->id, 'attribute_id' => $s1_a2->id, 'value' => '7kg',]);
        $s1_s3 = ProductSku::create(['product_id' => $s1->id, 'code' => 'xhsywkgpp011-15m', 'weight' => 230.8, 'cost_price' => 18.8,]);
        ProductSkuAttributeValue::create(['product_id' => $s1->id, 'sku_id' => $s1_s3->id, 'attribute_id' => $s1_a1->id, 'value' => '1/4寸',]);
        ProductSkuAttributeValue::create(['product_id' => $s1->id, 'sku_id' => $s1_s3->id, 'attribute_id' => $s1_a2->id, 'value' => '10kg',]);



        // 滚轮片
        $d1 = Product::create(['code' => 'xhslppp124', 'name' => 'pp滚轮片124', 'category_id' => 14,]);
        $d1_a1 = ProductAttribute::create(['product_id' => $d1->id, 'name' => '外径',]);
        $d1_a2 = ProductAttribute::create(['product_id' => $d1->id, 'name' => '内孔',]);
        $d1_a3 = ProductAttribute::create(['product_id' => $d1->id, 'name' => '有效长度',]);
        $d1_a4 = ProductAttribute::create(['product_id' => $d1->id, 'name' => '总长',]);
        $d1_s1 = ProductSku::create(['product_id' => $d1->id, 'code' => 'xhslppp124a', 'weight' => 25, 'cost_price' => 0.2,]);
        ProductSkuAttributeValue::create(['product_id' => $d1->id, 'sku_id' => $d1_s1->id, 'attribute_id' => $d1_a1->id, 'value' => '40cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d1->id, 'sku_id' => $d1_s1->id, 'attribute_id' => $d1_a2->id, 'value' => '8cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d1->id, 'sku_id' => $d1_s1->id, 'attribute_id' => $d1_a3->id, 'value' => '20cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d1->id, 'sku_id' => $d1_s1->id, 'attribute_id' => $d1_a4->id, 'value' => '30cm',]);
        $d1_s2 = ProductSku::create(['product_id' => $d1->id, 'code' => 'xhslppp124b', 'weight' => 25, 'cost_price' => 0.2,]);
        ProductSkuAttributeValue::create(['product_id' => $d1->id, 'sku_id' => $d1_s2->id, 'attribute_id' => $d1_a1->id, 'value' => '40cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d1->id, 'sku_id' => $d1_s2->id, 'attribute_id' => $d1_a2->id, 'value' => '10cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d1->id, 'sku_id' => $d1_s2->id, 'attribute_id' => $d1_a3->id, 'value' => '20cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d1->id, 'sku_id' => $d1_s2->id, 'attribute_id' => $d1_a4->id, 'value' => '30cm',]);
        $d1_s3 = ProductSku::create(['product_id' => $d1->id, 'code' => 'xhslppp124c', 'weight' => 25, 'cost_price' => 0.2,]);
        ProductSkuAttributeValue::create(['product_id' => $d1->id, 'sku_id' => $d1_s3->id, 'attribute_id' => $d1_a1->id, 'value' => '40cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d1->id, 'sku_id' => $d1_s3->id, 'attribute_id' => $d1_a2->id, 'value' => '12cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d1->id, 'sku_id' => $d1_s3->id, 'attribute_id' => $d1_a3->id, 'value' => '20cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d1->id, 'sku_id' => $d1_s3->id, 'attribute_id' => $d1_a4->id, 'value' => '30cm',]);

        $d2 = Product::create(['code' => 'xhslptpv162', 'name' => '孟山都滚轮片162', 'category_id' => 16,]);
        $d2_a1 = ProductAttribute::create(['product_id' => $d2->id, 'name' => '外径',]);
        $d2_a2 = ProductAttribute::create(['product_id' => $d2->id, 'name' => '内孔',]);
        $d2_a3 = ProductAttribute::create(['product_id' => $d2->id, 'name' => '有效长度',]);
        $d2_a4 = ProductAttribute::create(['product_id' => $d2->id, 'name' => '总长',]);
        $d2_s1 = ProductSku::create(['product_id' => $d2->id, 'code' => 'xhslptpv162a', 'weight' => 25, 'cost_price' => 0.6,]);
        ProductSkuAttributeValue::create(['product_id' => $d2->id, 'sku_id' => $d2_s1->id, 'attribute_id' => $d2_a1->id, 'value' => '22cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d2->id, 'sku_id' => $d2_s1->id, 'attribute_id' => $d2_a2->id, 'value' => '6cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d2->id, 'sku_id' => $d2_s1->id, 'attribute_id' => $d2_a3->id, 'value' => '10cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d2->id, 'sku_id' => $d2_s1->id, 'attribute_id' => $d2_a4->id, 'value' => '10cm',]);
        $d2_s2 = ProductSku::create(['product_id' => $d2->id, 'code' => 'xhslptpv162b', 'weight' => 25, 'cost_price' => 0.6,]);
        ProductSkuAttributeValue::create(['product_id' => $d2->id, 'sku_id' => $d2_s2->id, 'attribute_id' => $d2_a1->id, 'value' => '22cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d2->id, 'sku_id' => $d2_s2->id, 'attribute_id' => $d2_a2->id, 'value' => '8cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d2->id, 'sku_id' => $d2_s2->id, 'attribute_id' => $d2_a3->id, 'value' => '10cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d2->id, 'sku_id' => $d2_s2->id, 'attribute_id' => $d2_a4->id, 'value' => '10cm',]);

        $d3 = Product::create(['code' => 'xhslpngwa173', 'name' => '硅胶滚轮片A173', 'category_id' => 18,]);
        $d3_a1 = ProductAttribute::create(['product_id' => $d3->id, 'name' => '外径',]);
        $d3_a2 = ProductAttribute::create(['product_id' => $d3->id, 'name' => '内孔',]);
        $d3_a3 = ProductAttribute::create(['product_id' => $d3->id, 'name' => '有效长度',]);
        $d3_a4 = ProductAttribute::create(['product_id' => $d3->id, 'name' => '总长',]);
        $d3_s1 = ProductSku::create(['product_id' => $d3->id, 'code' => 'xhslpngwa173a', 'weight' => 25, 'cost_price' => 1.2,]);
        ProductSkuAttributeValue::create(['product_id' => $d3->id, 'sku_id' => $d3_s1->id, 'attribute_id' => $d3_a1->id, 'value' => '40cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d3->id, 'sku_id' => $d3_s1->id, 'attribute_id' => $d3_a2->id, 'value' => '8cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d3->id, 'sku_id' => $d3_s1->id, 'attribute_id' => $d3_a3->id, 'value' => '25cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d3->id, 'sku_id' => $d3_s1->id, 'attribute_id' => $d3_a4->id, 'value' => '25cm',]);
        $d3_s2 = ProductSku::create(['product_id' => $d3->id, 'code' => 'xhslpngwa173b', 'weight' => 25, 'cost_price' => 1.2,]);
        ProductSkuAttributeValue::create(['product_id' => $d3->id, 'sku_id' => $d3_s2->id, 'attribute_id' => $d3_a1->id, 'value' => '40cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d3->id, 'sku_id' => $d3_s2->id, 'attribute_id' => $d3_a2->id, 'value' => '10cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d3->id, 'sku_id' => $d3_s2->id, 'attribute_id' => $d3_a3->id, 'value' => '25cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d3->id, 'sku_id' => $d3_s2->id, 'attribute_id' => $d3_a4->id, 'value' => '25cm',]);

        $d4 = Product::create(['code' => 'xhslpbj159', 'name' => '包胶滚轮片159', 'category_id' => 15,]);
        $d4_a1 = ProductAttribute::create(['product_id' => $d4->id, 'name' => '外径',]);
        $d4_a2 = ProductAttribute::create(['product_id' => $d4->id, 'name' => '内孔',]);
        $d4_a3 = ProductAttribute::create(['product_id' => $d4->id, 'name' => '有效长度',]);
        $d4_a4 = ProductAttribute::create(['product_id' => $d4->id, 'name' => '总长',]);
        $d4_s1 = ProductSku::create(['product_id' => $d4->id, 'code' => 'xhslpbj159a', 'weight' => 40, 'cost_price' => 0.8,]);
        ProductSkuAttributeValue::create(['product_id' => $d4->id, 'sku_id' => $d4_s1->id, 'attribute_id' => $d4_a1->id, 'value' => '50cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d4->id, 'sku_id' => $d4_s1->id, 'attribute_id' => $d4_a2->id, 'value' => '8cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d4->id, 'sku_id' => $d4_s1->id, 'attribute_id' => $d4_a3->id, 'value' => '20cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d4->id, 'sku_id' => $d4_s1->id, 'attribute_id' => $d4_a4->id, 'value' => '30cm',]);
        $d4_s2 = ProductSku::create(['product_id' => $d4->id, 'code' => 'xhslpbj159b', 'weight' => 40, 'cost_price' => 0.8,]);
        ProductSkuAttributeValue::create(['product_id' => $d4->id, 'sku_id' => $d4_s2->id, 'attribute_id' => $d4_a1->id, 'value' => '50cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d4->id, 'sku_id' => $d4_s2->id, 'attribute_id' => $d4_a2->id, 'value' => '10cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d4->id, 'sku_id' => $d4_s2->id, 'attribute_id' => $d4_a3->id, 'value' => '20cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d4->id, 'sku_id' => $d4_s2->id, 'attribute_id' => $d4_a4->id, 'value' => '30cm',]);
        $d4_s3 = ProductSku::create(['product_id' => $d4->id, 'code' => 'xhslpbj159c', 'weight' => 40, 'cost_price' => 0.8,]);
        ProductSkuAttributeValue::create(['product_id' => $d4->id, 'sku_id' => $d4_s3->id, 'attribute_id' => $d4_a1->id, 'value' => '50cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d4->id, 'sku_id' => $d4_s3->id, 'attribute_id' => $d4_a2->id, 'value' => '12cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d4->id, 'sku_id' => $d4_s3->id, 'attribute_id' => $d4_a3->id, 'value' => '20cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d4->id, 'sku_id' => $d4_s3->id, 'attribute_id' => $d4_a4->id, 'value' => '30cm',]);

        $d5 = Product::create(['code' => 'xhslptj144gj', 'name' => '包胶滚轮片144骨架', 'category_id' => 17,]);
        $d5_a1 = ProductAttribute::create(['product_id' => $d5->id, 'name' => '内孔',]);
        $d5_a2 = ProductAttribute::create(['product_id' => $d5->id, 'name' => '有效长度',]);
        $d5_a3 = ProductAttribute::create(['product_id' => $d5->id, 'name' => '总长',]);
        $d5_s1 = ProductSku::create(['product_id' => $d5->id, 'code' => 'xhslptj144gja', 'weight' => 40, 'cost_price' => 0.25,]);
        ProductSkuAttributeValue::create(['product_id' => $d5->id, 'sku_id' => $d5_s1->id, 'attribute_id' => $d5_a1->id, 'value' => '8cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d5->id, 'sku_id' => $d5_s1->id, 'attribute_id' => $d5_a2->id, 'value' => '20cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d5->id, 'sku_id' => $d5_s1->id, 'attribute_id' => $d5_a3->id, 'value' => '30cm',]);
        $d5_s2 = ProductSku::create(['product_id' => $d5->id, 'code' => 'xhslptj144gjb', 'weight' => 40, 'cost_price' => 0.25,]);
        ProductSkuAttributeValue::create(['product_id' => $d5->id, 'sku_id' => $d5_s2->id, 'attribute_id' => $d5_a1->id, 'value' => '10cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d5->id, 'sku_id' => $d5_s2->id, 'attribute_id' => $d5_a2->id, 'value' => '20cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d5->id, 'sku_id' => $d5_s2->id, 'attribute_id' => $d5_a3->id, 'value' => '30cm',]);
        $d5_s3 = ProductSku::create(['product_id' => $d5->id, 'code' => 'xhslptj144gjc', 'weight' => 40, 'cost_price' => 0.25,]);
        ProductSkuAttributeValue::create(['product_id' => $d5->id, 'sku_id' => $d5_s3->id, 'attribute_id' => $d5_a1->id, 'value' => '12cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d5->id, 'sku_id' => $d5_s3->id, 'attribute_id' => $d5_a2->id, 'value' => '20cm',]);
        ProductSkuAttributeValue::create(['product_id' => $d5->id, 'sku_id' => $d5_s3->id, 'attribute_id' => $d5_a3->id, 'value' => '30cm',]);

        // 胶圈
        $r1 = Product::create(['code' => 'xhslptj144jq', 'name' => '包胶滚轮片144胶圈', 'category_id' => 20,]);
        $r1_a1 = ProductAttribute::create(['product_id' => $r1->id, 'name' => '外径',]);
        $r1_a2 = ProductAttribute::create(['product_id' => $r1->id, 'name' => '内孔',]);
        $r1_a3 = ProductAttribute::create(['product_id' => $r1->id, 'name' => '厚度',]);
        $r1_s1 = ProductSku::create(['product_id' => $r1->id, 'code' => 'xhslptj144jqpvc', 'weight' => 40, 'cost_price' => 0.25,]);
        ProductSkuAttributeValue::create(['product_id' => $r1->id, 'sku_id' => $r1_s1->id, 'attribute_id' => $r1_a1->id, 'value' => '40cm',]);
        ProductSkuAttributeValue::create(['product_id' => $r1->id, 'sku_id' => $r1_s1->id, 'attribute_id' => $r1_a2->id, 'value' => '36cm',]);
        ProductSkuAttributeValue::create(['product_id' => $r1->id, 'sku_id' => $r1_s1->id, 'attribute_id' => $r1_a3->id, 'value' => '10cm',]);
        $r1_s2 = ProductSku::create(['product_id' => $r1->id, 'code' => 'xhslptj144jqtpv', 'weight' => 40, 'cost_price' => 0.25,]);
        ProductSkuAttributeValue::create(['product_id' => $r1->id, 'sku_id' => $r1_s2->id, 'attribute_id' => $r1_a1->id, 'value' => '40cm',]);
        ProductSkuAttributeValue::create(['product_id' => $r1->id, 'sku_id' => $r1_s2->id, 'attribute_id' => $r1_a2->id, 'value' => '36cm',]);
        ProductSkuAttributeValue::create(['product_id' => $r1->id, 'sku_id' => $r1_s2->id, 'attribute_id' => $r1_a3->id, 'value' => '10cm',]);

        $r2 = Product::create(['code' => 'xhspz565jq', 'name' => '喷咀565胶圈', 'category_id' => 21,]);
        $r2_a1 = ProductAttribute::create(['product_id' => $r2->id, 'name' => '外径',]);
        $r2_a2 = ProductAttribute::create(['product_id' => $r2->id, 'name' => '内孔',]);
        $r2_a3 = ProductAttribute::create(['product_id' => $r2->id, 'name' => '厚度',]);
        $r2_s1 = ProductSku::create(['product_id' => $r2->id, 'code' => 'xhspz565jqpvc', 'weight' => 40, 'cost_price' => 0.25,]);
        ProductSkuAttributeValue::create(['product_id' => $r2->id, 'sku_id' => $r2_s1->id, 'attribute_id' => $r2_a1->id, 'value' => '40cm',]);
        ProductSkuAttributeValue::create(['product_id' => $r2->id, 'sku_id' => $r2_s1->id, 'attribute_id' => $r2_a2->id, 'value' => '36cm',]);
        ProductSkuAttributeValue::create(['product_id' => $r2->id, 'sku_id' => $r2_s1->id, 'attribute_id' => $r2_a3->id, 'value' => '10cm',]);
        $r2_s2 = ProductSku::create(['product_id' => $r2->id, 'code' => 'xhspz565jqtpv', 'weight' => 40, 'cost_price' => 0.25,]);
        ProductSkuAttributeValue::create(['product_id' => $r2->id, 'sku_id' => $r2_s2->id, 'attribute_id' => $r2_a1->id, 'value' => '40cm',]);
        ProductSkuAttributeValue::create(['product_id' => $r2->id, 'sku_id' => $r2_s2->id, 'attribute_id' => $r2_a2->id, 'value' => '36cm',]);
        ProductSkuAttributeValue::create(['product_id' => $r2->id, 'sku_id' => $r2_s2->id, 'attribute_id' => $r2_a3->id, 'value' => '10cm',]);

        $r3 = Product::create(['code' => 'xhsllj011jq', 'name' => '流量计胶圈', 'category_id' => 22,]);
        $r3_a1 = ProductAttribute::create(['product_id' => $r3->id, 'name' => '外径',]);
        $r3_a2 = ProductAttribute::create(['product_id' => $r3->id, 'name' => '内孔',]);
        $r3_a3 = ProductAttribute::create(['product_id' => $r3->id, 'name' => '厚度',]);
        $r3_s1 = ProductSku::create(['product_id' => $r3->id, 'code' => 'xhspz565jqpvc', 'weight' => 40, 'cost_price' => 0.25,]);
        ProductSkuAttributeValue::create(['product_id' => $r3->id, 'sku_id' => $r3_s1->id, 'attribute_id' => $r3_a1->id, 'value' => '40cm',]);
        ProductSkuAttributeValue::create(['product_id' => $r3->id, 'sku_id' => $r3_s1->id, 'attribute_id' => $r3_a2->id, 'value' => '36cm',]);
        ProductSkuAttributeValue::create(['product_id' => $r3->id, 'sku_id' => $r3_s1->id, 'attribute_id' => $r3_a3->id, 'value' => '5cm',]);
        $r3_s2 = ProductSku::create(['product_id' => $r3->id, 'code' => 'xhspz565jqtpv', 'weight' => 40, 'cost_price' => 0.25,]);
        ProductSkuAttributeValue::create(['product_id' => $r3->id, 'sku_id' => $r3_s2->id, 'attribute_id' => $r3_a1->id, 'value' => '40cm',]);
        ProductSkuAttributeValue::create(['product_id' => $r3->id, 'sku_id' => $r3_s2->id, 'attribute_id' => $r3_a2->id, 'value' => '36cm',]);
        ProductSkuAttributeValue::create(['product_id' => $r3->id, 'sku_id' => $r3_s2->id, 'attribute_id' => $r3_a3->id, 'value' => '5cm',]);

        // 喷咀
        $n1 = Product::create(['code' => 'xhspz565head', 'name' => '565喷咀头', 'category_id' => 42,]);
        $n1_a1 = ProductAttribute::create(['product_id' => $n1->id, 'name' => '流量',]);
        $n1_a2 = ProductAttribute::create(['product_id' => $n1->id, 'name' => '材质',]);
        $n1_a3 = ProductAttribute::create(['product_id' => $n1->id, 'name' => '颜色',]);
        $n1_s1 = ProductSku::create(['product_id' => $n1->id, 'code' => 'xhspz565heada', 'weight' => 40, 'cost_price' => 0.8,]);
        ProductSkuAttributeValue::create(['product_id' => $n1->id, 'sku_id' => $n1_s1->id, 'attribute_id' => $n1_a1->id, 'value' => '5602',]);
        ProductSkuAttributeValue::create(['product_id' => $n1->id, 'sku_id' => $n1_s1->id, 'attribute_id' => $n1_a2->id, 'value' => 'pp',]);
        ProductSkuAttributeValue::create(['product_id' => $n1->id, 'sku_id' => $n1_s1->id, 'attribute_id' => $n1_a3->id, 'value' => '黑色',]);
        $n1_s2 = ProductSku::create(['product_id' => $n1->id, 'code' => 'xhspz565headb', 'weight' => 40, 'cost_price' => 0.8,]);
        ProductSkuAttributeValue::create(['product_id' => $n1->id, 'sku_id' => $n1_s2->id, 'attribute_id' => $n1_a1->id, 'value' => '5605',]);
        ProductSkuAttributeValue::create(['product_id' => $n1->id, 'sku_id' => $n1_s2->id, 'attribute_id' => $n1_a2->id, 'value' => 'pvdf',]);
        ProductSkuAttributeValue::create(['product_id' => $n1->id, 'sku_id' => $n1_s2->id, 'attribute_id' => $n1_a3->id, 'value' => '白色',]);
        $n1_s3 = ProductSku::create(['product_id' => $n1->id, 'code' => 'xhspz565headc', 'weight' => 40, 'cost_price' => 0.8,]);
        ProductSkuAttributeValue::create(['product_id' => $n1->id, 'sku_id' => $n1_s3->id, 'attribute_id' => $n1_a1->id, 'value' => '5608',]);
        ProductSkuAttributeValue::create(['product_id' => $n1->id, 'sku_id' => $n1_s3->id, 'attribute_id' => $n1_a2->id, 'value' => 'pvdf',]);
        ProductSkuAttributeValue::create(['product_id' => $n1->id, 'sku_id' => $n1_s3->id, 'attribute_id' => $n1_a3->id, 'value' => '黑色',]);

        $n2 = Product::create(['code' => 'xhspz565bottom', 'name' => '565喷咀底座', 'category_id' => 44,]);
        $n2_a1 = ProductAttribute::create(['product_id' => $n2->id, 'name' => '牙口',]);
        $n2_a2 = ProductAttribute::create(['product_id' => $n2->id, 'name' => '材质',]);
        $n2_a3 = ProductAttribute::create(['product_id' => $n2->id, 'name' => '颜色',]);
        $n2_s1 = ProductSku::create(['product_id' => $n2->id, 'code' => 'xhspz565bottoma', 'weight' => 40, 'cost_price' => 0.8,]);
        ProductSkuAttributeValue::create(['product_id' => $n2->id, 'sku_id' => $n2_s1->id, 'attribute_id' => $n2_a1->id, 'value' => '1/4寸',]);
        ProductSkuAttributeValue::create(['product_id' => $n2->id, 'sku_id' => $n2_s1->id, 'attribute_id' => $n2_a2->id, 'value' => 'pp',]);
        ProductSkuAttributeValue::create(['product_id' => $n2->id, 'sku_id' => $n2_s1->id, 'attribute_id' => $n2_a3->id, 'value' => '黑色',]);
        $n2_s2 = ProductSku::create(['product_id' => $n2->id, 'code' => 'xhspz565bottomb', 'weight' => 40, 'cost_price' => 0.8,]);
        ProductSkuAttributeValue::create(['product_id' => $n2->id, 'sku_id' => $n2_s2->id, 'attribute_id' => $n2_a1->id, 'value' => '1/2寸',]);
        ProductSkuAttributeValue::create(['product_id' => $n2->id, 'sku_id' => $n2_s2->id, 'attribute_id' => $n2_a2->id, 'value' => 'pvdf',]);
        ProductSkuAttributeValue::create(['product_id' => $n2->id, 'sku_id' => $n2_s2->id, 'attribute_id' => $n2_a3->id, 'value' => '白色',]);
        $n2_s3 = ProductSku::create(['product_id' => $n2->id, 'code' => 'xhspz565bottomc', 'weight' => 40, 'cost_price' => 0.8,]);
        ProductSkuAttributeValue::create(['product_id' => $n2->id, 'sku_id' => $n2_s3->id, 'attribute_id' => $n2_a1->id, 'value' => '1寸',]);
        ProductSkuAttributeValue::create(['product_id' => $n2->id, 'sku_id' => $n2_s3->id, 'attribute_id' => $n2_a2->id, 'value' => 'pvdf',]);
        ProductSkuAttributeValue::create(['product_id' => $n2->id, 'sku_id' => $n2_s3->id, 'attribute_id' => $n2_a3->id, 'value' => '黑色',]);

        // 流量计
        $f1 = Product::create(['code' => 'xhsllj011sg', 'name' => '流量计011视管', 'category_id' => 25,]);
        $f1_a1 = ProductAttribute::create(['product_id' => $f1->id, 'name' => '高度',]);
        $f1_a2 = ProductAttribute::create(['product_id' => $f1->id, 'name' => '外径',]);
        $f1_a3 = ProductAttribute::create(['product_id' => $f1->id, 'name' => '材质',]);
        $f1_s1 = ProductSku::create(['product_id' => $f1->id, 'code' => 'xhsllj011sgpc', 'weight' => 40, 'cost_price' => 25,]);
        ProductSkuAttributeValue::create(['product_id' => $f1->id, 'sku_id' => $f1_s1->id, 'attribute_id' => $f1_a1->id, 'value' => '120mm',]);
        ProductSkuAttributeValue::create(['product_id' => $f1->id, 'sku_id' => $f1_s1->id, 'attribute_id' => $f1_a2->id, 'value' => '60mm',]);
        ProductSkuAttributeValue::create(['product_id' => $f1->id, 'sku_id' => $f1_s1->id, 'attribute_id' => $f1_a3->id, 'value' => 'PC',]);
        $f1_s2 = ProductSku::create(['product_id' => $f1->id, 'code' => 'xhsllj011sgpvc', 'weight' => 40, 'cost_price' => 25,]);
        ProductSkuAttributeValue::create(['product_id' => $f1->id, 'sku_id' => $f1_s2->id, 'attribute_id' => $f1_a1->id, 'value' => '120mm',]);
        ProductSkuAttributeValue::create(['product_id' => $f1->id, 'sku_id' => $f1_s2->id, 'attribute_id' => $f1_a2->id, 'value' => '60mm',]);
        ProductSkuAttributeValue::create(['product_id' => $f1->id, 'sku_id' => $f1_s2->id, 'attribute_id' => $f1_a3->id, 'value' => 'PVC',]);
        $f1_s3 = ProductSku::create(['product_id' => $f1->id, 'code' => 'xhsllj011sgpsu', 'weight' => 40, 'cost_price' => 25,]);
        ProductSkuAttributeValue::create(['product_id' => $f1->id, 'sku_id' => $f1_s3->id, 'attribute_id' => $f1_a1->id, 'value' => '120mm',]);
        ProductSkuAttributeValue::create(['product_id' => $f1->id, 'sku_id' => $f1_s3->id, 'attribute_id' => $f1_a2->id, 'value' => '60mm',]);
        ProductSkuAttributeValue::create(['product_id' => $f1->id, 'sku_id' => $f1_s3->id, 'attribute_id' => $f1_a3->id, 'value' => 'PSU',]);

        $f2 = Product::create(['code' => 'xhsllj011dg', 'name' => '流量计011导轨', 'category_id' => 33,]);
        $f2_a1 = ProductAttribute::create(['product_id' => $f2->id, 'name' => '长度',]);
        $f2_a2 = ProductAttribute::create(['product_id' => $f2->id, 'name' => '外径',]);
        $f2_a3 = ProductAttribute::create(['product_id' => $f2->id, 'name' => '材质',]);
        $f2_s1 = ProductSku::create(['product_id' => $f2->id, 'code' => 'xhsllj011dgsus316', 'weight' => 40, 'cost_price' => 25,]);
        ProductSkuAttributeValue::create(['product_id' => $f2->id, 'sku_id' => $f2_s1->id, 'attribute_id' => $f2_a1->id, 'value' => '130mm',]);
        ProductSkuAttributeValue::create(['product_id' => $f2->id, 'sku_id' => $f2_s1->id, 'attribute_id' => $f2_a2->id, 'value' => '6mm',]);
        ProductSkuAttributeValue::create(['product_id' => $f2->id, 'sku_id' => $f2_s1->id, 'attribute_id' => $f2_a3->id, 'value' => 'SUS316',]);
        $f2_s2 = ProductSku::create(['product_id' => $f2->id, 'code' => 'xhsllj011dgtxb', 'weight' => 40, 'cost_price' => 25,]);
        ProductSkuAttributeValue::create(['product_id' => $f2->id, 'sku_id' => $f2_s2->id, 'attribute_id' => $f2_a1->id, 'value' => '130mm',]);
        ProductSkuAttributeValue::create(['product_id' => $f2->id, 'sku_id' => $f2_s2->id, 'attribute_id' => $f2_a2->id, 'value' => '6mm',]);
        ProductSkuAttributeValue::create(['product_id' => $f2->id, 'sku_id' => $f2_s2->id, 'attribute_id' => $f2_a3->id, 'value' => '碳纤棒',]);

        $f3 = Product::create(['code' => 'xhsllj011zz', 'name' => '流量计011转子', 'category_id' => 28,]);
        $f3_a1 = ProductAttribute::create(['product_id' => $f3->id, 'name' => '重量',]);
        $f3_a2 = ProductAttribute::create(['product_id' => $f3->id, 'name' => '外径',]);
        $f3_a3 = ProductAttribute::create(['product_id' => $f3->id, 'name' => '材质',]);
        $f3_s1 = ProductSku::create(['product_id' => $f3->id, 'code' => 'xhsllj011zzsus316', 'weight' => 40, 'cost_price' => 25,]);
        ProductSkuAttributeValue::create(['product_id' => $f3->id, 'sku_id' => $f3_s1->id, 'attribute_id' => $f3_a1->id, 'value' => '200g',]);
        ProductSkuAttributeValue::create(['product_id' => $f3->id, 'sku_id' => $f3_s1->id, 'attribute_id' => $f3_a2->id, 'value' => '20mm',]);
        ProductSkuAttributeValue::create(['product_id' => $f3->id, 'sku_id' => $f3_s1->id, 'attribute_id' => $f3_a3->id, 'value' => 'SUS316',]);
        $f3_s2 = ProductSku::create(['product_id' => $f3->id, 'code' => 'xhsllj011zztfl', 'weight' => 40, 'cost_price' => 25,]);
        ProductSkuAttributeValue::create(['product_id' => $f3->id, 'sku_id' => $f3_s2->id, 'attribute_id' => $f3_a1->id, 'value' => '150g',]);
        ProductSkuAttributeValue::create(['product_id' => $f3->id, 'sku_id' => $f3_s2->id, 'attribute_id' => $f3_a2->id, 'value' => '20mm',]);
        ProductSkuAttributeValue::create(['product_id' => $f3->id, 'sku_id' => $f3_s2->id, 'attribute_id' => $f3_a3->id, 'value' => '铁氟龙',]);

        $f4 = Product::create(['code' => 'xhsllj011lm', 'name' => '流量计011螺母', 'category_id' => 36,]);
        $f4_a1 = ProductAttribute::create(['product_id' => $f4->id, 'name' => '重量',]);
        $f4_a2 = ProductAttribute::create(['product_id' => $f4->id, 'name' => '外径',]);
        $f4_a3 = ProductAttribute::create(['product_id' => $f4->id, 'name' => '材质',]);
        $f4_s1 = ProductSku::create(['product_id' => $f4->id, 'code' => 'xhsllj011lm316', 'weight' => 40, 'cost_price' => 6,]);
        ProductSkuAttributeValue::create(['product_id' => $f4->id, 'sku_id' => $f4_s1->id, 'attribute_id' => $f4_a1->id, 'value' => '200g',]);
        ProductSkuAttributeValue::create(['product_id' => $f4->id, 'sku_id' => $f4_s1->id, 'attribute_id' => $f4_a2->id, 'value' => '30mm',]);
        ProductSkuAttributeValue::create(['product_id' => $f4->id, 'sku_id' => $f4_s1->id, 'attribute_id' => $f4_a3->id, 'value' => 'PVC',]);

        $f5 = Product::create(['code' => 'xhsllj011jt', 'name' => '流量计011接头', 'category_id' => 37,]);
        $f5_a1 = ProductAttribute::create(['product_id' => $f5->id, 'name' => '接头方式',]);
        $f5_a2 = ProductAttribute::create(['product_id' => $f5->id, 'name' => '尺寸',]);
        $f5_a3 = ProductAttribute::create(['product_id' => $f5->id, 'name' => '材质',]);
        $f5_s1 = ProductSku::create(['product_id' => $f5->id, 'code' => 'xhsllj011jtpvc', 'weight' => 40, 'cost_price' => 25,]);
        ProductSkuAttributeValue::create(['product_id' => $f5->id, 'sku_id' => $f5_s1->id, 'attribute_id' => $f5_a1->id, 'value' => '牙口',]);
        ProductSkuAttributeValue::create(['product_id' => $f5->id, 'sku_id' => $f5_s1->id, 'attribute_id' => $f5_a2->id, 'value' => '1/2',]);
        ProductSkuAttributeValue::create(['product_id' => $f5->id, 'sku_id' => $f5_s1->id, 'attribute_id' => $f5_a3->id, 'value' => 'PVC',]);
        $f5_s2 = ProductSku::create(['product_id' => $f5->id, 'code' => 'xhsllj011jtpp', 'weight' => 40, 'cost_price' => 25,]);
        ProductSkuAttributeValue::create(['product_id' => $f5->id, 'sku_id' => $f5_s2->id, 'attribute_id' => $f5_a1->id, 'value' => '焊接',]);
        ProductSkuAttributeValue::create(['product_id' => $f5->id, 'sku_id' => $f5_s2->id, 'attribute_id' => $f5_a2->id, 'value' => '1寸',]);
        ProductSkuAttributeValue::create(['product_id' => $f5->id, 'sku_id' => $f5_s2->id, 'attribute_id' => $f5_a3->id, 'value' => 'pp',]);

        $f6 = Product::create(['code' => 'xhsllj011zsk', 'name' => '流量计011指示扣', 'category_id' => 40,]);
        $f6_a1 = ProductAttribute::create(['product_id' => $f6->id, 'name' => '材质',]);
        $f6_a2 = ProductAttribute::create(['product_id' => $f6->id, 'name' => '颜色',]);
        $f6_s1 = ProductSku::create(['product_id' => $f6->id, 'code' => 'xhsllj011zsk001', 'weight' => 40, 'cost_price' => 0.5,]);
        ProductSkuAttributeValue::create(['product_id' => $f6->id, 'sku_id' => $f6_s1->id, 'attribute_id' => $f6_a1->id, 'value' => 'pp',]);
        ProductSkuAttributeValue::create(['product_id' => $f6->id, 'sku_id' => $f6_s1->id, 'attribute_id' => $f6_a2->id, 'value' => '红色',]);
    }
}