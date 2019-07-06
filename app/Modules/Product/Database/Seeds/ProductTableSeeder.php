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
    }
}