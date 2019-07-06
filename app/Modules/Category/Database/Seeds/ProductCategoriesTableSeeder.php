<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/6
 * Time: 15:59
 */

namespace App\Modules\Category\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Modules\Category\Models\ProductCategory;

class ProductCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        // 压力表
        $pressure_meter = ProductCategory::create([
            'name' => '压力表',
            'display_name' => '压力表',
        ]);
        ProductCategory::create([
            'name' => '不锈钢压力表',
            'display_name' => '不锈钢压力表',
            'parent_id' => $pressure_meter->id,
        ]);
        ProductCategory::create([
            'name' => 'PP压力表',
            'display_name' => 'PP压力表',
            'parent_id' => $pressure_meter->id,
        ]);

        // 液位开关
        $level_switch = ProductCategory::create([
            'name' => '液位开关',
            'display_name' => '液位开关',
        ]);
        $vertical_switch = ProductCategory::create([
            'name' => '立式液位开关',
            'display_name' => '立式液位开关',
            'parent_id' => $level_switch->id,
        ]);
        ProductCategory::create([
            'name' => 'PP立式液位开关',
            'display_name' => 'PP立式液位开关',
            'parent_id' => $vertical_switch->id,
        ]);
        ProductCategory::create([
            'name' => 'PVDF立式液位开关',
            'display_name' => 'PVDF立式液位开关',
            'parent_id' => $vertical_switch->id,
        ]);
        ProductCategory::create([
            'name' => '304立式液位开关',
            'display_name' => '304立式液位开关',
            'parent_id' => $vertical_switch->id,
        ]);
        $horizontal_switch = ProductCategory::create([
            'name' => '卧式液位开关',
            'display_name' => '卧式液位开关',
            'parent_id' => $level_switch->id,
        ]);
        ProductCategory::create([
            'name' => 'PP卧式液位开关',
            'display_name' => 'PP卧式液位开关',
            'parent_id' => $horizontal_switch->id,
        ]);
        ProductCategory::create([
            'name' => 'PVDF卧式液位开关',
            'display_name' => 'PVDF卧式液位开关',
            'parent_id' => $horizontal_switch->id,
        ]);
        ProductCategory::create([
            'name' => '304卧式液位开关',
            'display_name' => '304卧式液位开关',
            'parent_id' => $horizontal_switch->id,
        ]);

        // 滚轮片
        $disk = ProductCategory::create([
            'name' => '滚轮片',
            'display_name' => '滚轮片',
        ]);
        ProductCategory::create([
            'name' => 'PP滚轮片',
            'display_name' => 'PP滚轮片',
            'parent_id' => $disk->id,
        ]);
        ProductCategory::create([
            'name' => '包胶滚轮片',
            'display_name' => '包胶滚轮片',
            'parent_id' => $disk->id,
        ]);
        ProductCategory::create([
            'name' => '轮片骨架',
            'display_name' => '轮片骨架',
            'parent_id' => $disk->id,
        ]);
        ProductCategory::create([
            'name' => '耐高温滚轮片',
            'display_name' => '耐高温滚轮片',
            'parent_id' => $disk->id,
        ]);

        // 胶圈
        $rubber_gasket = ProductCategory::create([
            'name' => '胶圈',
            'display_name' => '胶圈',
        ]);
        ProductCategory::create([
            'name' => '轮片胶圈',
            'display_name' => '轮片胶圈',
            'parent_id' => $rubber_gasket->id,
        ]);
        ProductCategory::create([
            'name' => '喷咀胶圈',
            'display_name' => '喷咀胶圈',
            'parent_id' => $rubber_gasket->id,
        ]);
        ProductCategory::create([
            'name' => '流量计胶圈',
            'display_name' => '流量计胶圈',
            'parent_id' => $rubber_gasket->id,
        ]);

        //流量计配件
        $flowmeter_parts = ProductCategory::create([
            'name' => '流量计配件',
            'display_name' => '流量计配件',
        ]);
        $tube = ProductCategory::create([
            'name' => '视管',
            'display_name' => '视管',
            'parent_id' => $flowmeter_parts->id,
        ]);
        ProductCategory::create([
            'name' => 'PC视管',
            'display_name' => 'PC视管',
            'parent_id' => $tube->id,
        ]);
        ProductCategory::create([
            'name' => 'PVC视管',
            'display_name' => 'PVC视管',
            'parent_id' => $tube->id,
        ]);
        ProductCategory::create([
            'name' => 'PSU视管',
            'display_name' => 'PSU视管',
            'parent_id' => $tube->id,
        ]);
        $rotor = ProductCategory::create([
            'name' => '转子',
            'display_name' => '转子',
            'parent_id' => $flowmeter_parts->id,
        ]);
        ProductCategory::create([
            'name' => '304转子',
            'display_name' => '304转子',
            'parent_id' => $rotor->id,
        ]);
        ProductCategory::create([
            'name' => '316转子',
            'display_name' => '316转子',
            'parent_id' => $rotor->id,
        ]);
        ProductCategory::create([
            'name' => '铁氟龙转子',
            'display_name' => '铁氟龙转子',
            'parent_id' => $rotor->id,
        ]);
        ProductCategory::create([
            'name' => '钛转子',
            'display_name' => '钛转子',
            'parent_id' => $rotor->id,
        ]);
        $guide = ProductCategory::create([
            'name' => '导轨',
            'display_name' => '导轨',
            'parent_id' => $flowmeter_parts->id,
        ]);
        ProductCategory::create([
            'name' => '316导轨',
            'display_name' => '316导轨',
            'parent_id' => $guide->id,
        ]);
        ProductCategory::create([
            'name' => '碳纤棒导轨',
            'display_name' => '碳纤棒导轨',
            'parent_id' => $guide->id,
        ]);
        ProductCategory::create([
            'name' => '螺母',
            'display_name' => '螺母',
            'parent_id' => $flowmeter_parts->id,
        ]);
        $joint = ProductCategory::create([
            'name' => '接头',
            'display_name' => '接头',
            'parent_id' => $flowmeter_parts->id,
        ]);
        ProductCategory::create([
            'name' => 'PVC接头',
            'display_name' => 'PVC接头',
            'parent_id' => $joint->id,
        ]);
        ProductCategory::create([
            'name' => 'PP接头',
            'display_name' => 'PP接头',
            'parent_id' => $joint->id,
        ]);
        ProductCategory::create([
            'name' => '指示扣',
            'display_name' => '指示扣',
            'parent_id' => $flowmeter_parts->id,
        ]);

        // 喷咀配件
        $nozzle_parts = ProductCategory::create([
            'name' => '喷咀配件',
            'display_name' => '喷咀配件',
        ]);
        ProductCategory::create([
            'name' => '喷咀头',
            'display_name' => '喷咀头',
            'parent_id' => $nozzle_parts->id,
        ]);
        ProductCategory::create([
            'name' => '喷嘴芯',
            'display_name' => '喷嘴芯',
            'parent_id' => $nozzle_parts->id,
        ]);
        ProductCategory::create([
            'name' => '底座',
            'display_name' => '底座',
            'parent_id' => $nozzle_parts->id,
        ]);
    }
}