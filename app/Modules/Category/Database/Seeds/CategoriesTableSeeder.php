<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/20
 * Time: 16:53
 */

namespace App\Modules\Category\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Modules\Category\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $this->seedProductCategory();
        $this->seedGoodsCategory();
    }

    protected function seedProductCategory()
    {
        // 压力表
        $pressure_meter = Category::create([
            'name' => '压力表',
            'display_name' => '压力表',
            'type' => 1,
        ]);
        Category::create([
            'name' => '不锈钢压力表',
            'display_name' => '不锈钢压力表',
            'parent_id' => $pressure_meter->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => 'PP压力表',
            'display_name' => 'PP压力表',
            'parent_id' => $pressure_meter->id,
            'type' => 1,
        ]);

        // 液位开关
        $level_switch = Category::create([
            'name' => '液位开关',
            'display_name' => '液位开关',
            'type' => 1,
        ]);
        $vertical_switch = Category::create([
            'name' => '立式液位开关',
            'display_name' => '立式液位开关',
            'parent_id' => $level_switch->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => 'PP立式液位开关',
            'display_name' => 'PP立式液位开关',
            'parent_id' => $vertical_switch->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => 'PVDF立式液位开关',
            'display_name' => 'PVDF立式液位开关',
            'parent_id' => $vertical_switch->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => '304立式液位开关',
            'display_name' => '304立式液位开关',
            'parent_id' => $vertical_switch->id,
            'type' => 1,
        ]);
        $horizontal_switch = Category::create([
            'name' => '卧式液位开关',
            'display_name' => '卧式液位开关',
            'parent_id' => $level_switch->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => 'PP卧式液位开关',
            'display_name' => 'PP卧式液位开关',
            'parent_id' => $horizontal_switch->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => 'PVDF卧式液位开关',
            'display_name' => 'PVDF卧式液位开关',
            'parent_id' => $horizontal_switch->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => '304卧式液位开关',
            'display_name' => '304卧式液位开关',
            'parent_id' => $horizontal_switch->id,
            'type' => 1,
        ]);

        // 滚轮片
        $disk = Category::create([
            'name' => '滚轮片',
            'display_name' => '滚轮片',
            'type' => 1,
        ]);
        Category::create([
            'name' => 'PP滚轮片',
            'display_name' => 'PP滚轮片',
            'parent_id' => $disk->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => '包胶滚轮片',
            'display_name' => '包胶滚轮片',
            'parent_id' => $disk->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => '孟山都滚轮片',
            'display_name' => '孟山都滚轮片',
            'parent_id' => $disk->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => '轮片骨架',
            'display_name' => '轮片骨架',
            'parent_id' => $disk->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => '耐高温滚轮片',
            'display_name' => '耐高温滚轮片',
            'parent_id' => $disk->id,
            'type' => 1,
        ]);

        // 胶圈
        $rubber_gasket = Category::create([
            'name' => '胶圈',
            'display_name' => '胶圈',
            'type' => 1,
        ]);
        Category::create([
            'name' => '轮片胶圈',
            'display_name' => '轮片胶圈',
            'parent_id' => $rubber_gasket->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => '喷咀胶圈',
            'display_name' => '喷咀胶圈',
            'parent_id' => $rubber_gasket->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => '流量计胶圈',
            'display_name' => '流量计胶圈',
            'parent_id' => $rubber_gasket->id,
            'type' => 1,
        ]);

        //流量计配件
        $flowmeter_parts = Category::create([
            'name' => '流量计配件',
            'display_name' => '流量计配件',
            'type' => 1,
        ]);
        $tube = Category::create([
            'name' => '视管',
            'display_name' => '视管',
            'parent_id' => $flowmeter_parts->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => 'PC视管',
            'display_name' => 'PC视管',
            'parent_id' => $tube->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => 'PVC视管',
            'display_name' => 'PVC视管',
            'parent_id' => $tube->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => 'PSU视管',
            'display_name' => 'PSU视管',
            'parent_id' => $tube->id,
            'type' => 1,
        ]);
        $rotor = Category::create([
            'name' => '转子',
            'display_name' => '转子',
            'parent_id' => $flowmeter_parts->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => '304转子',
            'display_name' => '304转子',
            'parent_id' => $rotor->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => '316转子',
            'display_name' => '316转子',
            'parent_id' => $rotor->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => '铁氟龙转子',
            'display_name' => '铁氟龙转子',
            'parent_id' => $rotor->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => '钛转子',
            'display_name' => '钛转子',
            'parent_id' => $rotor->id,
            'type' => 1,
        ]);
        $guide = Category::create([
            'name' => '导轨',
            'display_name' => '导轨',
            'parent_id' => $flowmeter_parts->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => '316导轨',
            'display_name' => '316导轨',
            'parent_id' => $guide->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => '碳纤棒导轨',
            'display_name' => '碳纤棒导轨',
            'parent_id' => $guide->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => '螺母',
            'display_name' => '螺母',
            'parent_id' => $flowmeter_parts->id,
            'type' => 1,
        ]);
        $joint = Category::create([
            'name' => '接头',
            'display_name' => '接头',
            'parent_id' => $flowmeter_parts->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => 'PVC接头',
            'display_name' => 'PVC接头',
            'parent_id' => $joint->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => 'PP接头',
            'display_name' => 'PP接头',
            'parent_id' => $joint->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => '指示扣',
            'display_name' => '指示扣',
            'parent_id' => $flowmeter_parts->id,
            'type' => 1,
        ]);

        // 喷咀配件
        $nozzle_parts = Category::create([
            'name' => '喷咀配件',
            'display_name' => '喷咀配件',
            'type' => 1,
        ]);
        Category::create([
            'name' => '喷咀头',
            'display_name' => '喷咀头',
            'parent_id' => $nozzle_parts->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => '喷嘴芯',
            'display_name' => '喷嘴芯',
            'parent_id' => $nozzle_parts->id,
            'type' => 1,
        ]);
        Category::create([
            'name' => '底座',
            'display_name' => '底座',
            'parent_id' => $nozzle_parts->id,
            'type' => 1,
        ]);
    }

    protected function seedGoodsCategory()
    {
        // 压力表
        $pressure_meter = Category::create([
            'name' => '压力表',
            'display_name' => '压力表',
            'type' => 2,
        ]);
        Category::create([
            'name' => '不锈钢压力表',
            'display_name' => '不锈钢压力表',
            'parent_id' => $pressure_meter->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => 'PP压力表',
            'display_name' => 'PP压力表',
            'parent_id' => $pressure_meter->id,
            'type' => 2,
        ]);

        // 液位开关
        $level_switch = Category::create([
            'name' => '液位开关',
            'display_name' => '液位开关',
            'type' => 2,
        ]);
        $vertical_switch = Category::create([
            'name' => '立式液位开关',
            'display_name' => '立式液位开关',
            'parent_id' => $level_switch->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => 'PP立式液位开关',
            'display_name' => 'PP立式液位开关',
            'parent_id' => $vertical_switch->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => 'PVDF立式液位开关',
            'display_name' => 'PVDF立式液位开关',
            'parent_id' => $vertical_switch->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => '304立式液位开关',
            'display_name' => '304立式液位开关',
            'parent_id' => $vertical_switch->id,
            'type' => 2,
        ]);
        $horizontal_switch = Category::create([
            'name' => '卧式液位开关',
            'display_name' => '卧式液位开关',
            'parent_id' => $level_switch->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => 'PP卧式液位开关',
            'display_name' => 'PP卧式液位开关',
            'parent_id' => $horizontal_switch->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => 'PVDF卧式液位开关',
            'display_name' => 'PVDF卧式液位开关',
            'parent_id' => $horizontal_switch->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => '304卧式液位开关',
            'display_name' => '304卧式液位开关',
            'parent_id' => $horizontal_switch->id,
            'type' => 2,
        ]);

        // 滚轮片
        $disk = Category::create([
            'name' => '滚轮片',
            'display_name' => '滚轮片',
            'type' => 2,
        ]);
        Category::create([
            'name' => 'PP滚轮片',
            'display_name' => 'PP滚轮片',
            'parent_id' => $disk->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => '包胶滚轮片',
            'display_name' => '包胶滚轮片',
            'parent_id' => $disk->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => '孟山都滚轮片',
            'display_name' => '孟山都滚轮片',
            'parent_id' => $disk->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => '耐高温滚轮片',
            'display_name' => '耐高温滚轮片',
            'parent_id' => $disk->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => 'LCD收板机滚轮片',
            'display_name' => 'LCD收板机滚轮片',
            'parent_id' => $disk->id,
            'type' => 2,
        ]);

        // 连接套
        Category::create([
            'name' => '连接套',
            'display_name' => '连接套',
            'type' => 2,
        ]);

        // 插件
        Category::create([
            'name' => '插件',
            'display_name' => '插件',
            'type' => 2,
        ]);

        // 齿轮
        $gear = Category::create([
            'name' => '齿轮',
            'display_name' => '齿轮',
            'type' => 2,
        ]);
        Category::create([
            'name' => '直齿轮',
            'display_name' => '直齿轮',
            'parent_id' => $gear->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => '伞齿轮',
            'display_name' => '伞齿轮',
            'parent_id' => $gear->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => '钉齿轮',
            'display_name' => '钉齿轮',
            'parent_id' => $gear->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => '螺旋齿轮',
            'display_name' => '螺旋齿轮',
            'parent_id' => $gear->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => '组合齿轮',
            'display_name' => '组合齿轮',
            'parent_id' => $gear->id,
            'type' => 2,
        ]);

        // 喷咀喷管
        $nozzle = Category::create([
            'name' => '喷咀喷管',
            'display_name' => '喷咀喷管',
            'type' => 2,
        ]);
        Category::create([
            'name' => '喷管',
            'display_name' => '喷管',
            'parent_id' => $nozzle->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => '喷咀',
            'display_name' => '喷咀',
            'parent_id' => $nozzle->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => '喷嘴芯',
            'display_name' => '喷嘴芯',
            'parent_id' => $nozzle->id,
            'type' => 2,
        ]);

        // 异型材
        $profile_bar = Category::create([
            'name' => '异型材',
            'display_name' => '异型材',
            'type' => 2,
        ]);
        Category::create([
            'name' => '拉手',
            'display_name' => '拉手',
            'parent_id' => $profile_bar->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => '水泵过滤器配件',
            'display_name' => '水泵过滤器配件',
            'parent_id' => $profile_bar->id,
            'type' => 2,
        ]);

        // 滚轮
        $roller = Category::create([
            'name' => '滚轮',
            'display_name' => '滚轮',
            'type' => 2,
        ]);
        Category::create([
            'name' => '行辘',
            'display_name' => '行辘',
            'parent_id' => $roller->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => '压辘',
            'display_name' => '压辘',
            'parent_id' => $roller->id,
            'type' => 2,
        ]);

        // 轴心
        $axis = Category::create([
            'name' => '轴心',
            'display_name' => '轴心',
            'type' => 2,
        ]);
        Category::create([
            'name' => '玻纤棒',
            'display_name' => '玻纤棒',
            'parent_id' => $axis->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => '碳纤棒',
            'display_name' => '碳纤棒',
            'parent_id' => $axis->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => '304不锈钢棒',
            'display_name' => '304不锈钢棒',
            'parent_id' => $axis->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => '316不锈钢棒',
            'display_name' => '316不锈钢棒',
            'parent_id' => $axis->id,
            'type' => 2,
        ]);

        // 流量计
        $flowmeter = Category::create([
            'name' => '流量计',
            'display_name' => '流量计',
            'type' => 2,
        ]);
        Category::create([
            'name' => '国产流量计',
            'display_name' => '国产流量计',
            'parent_id' => $flowmeter->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => '加强型流量计',
            'display_name' => '加强型流量计',
            'parent_id' => $flowmeter->id,
            'type' => 2,
        ]);
        Category::create([
            'name' => 'Kingspring流量计',
            'display_name' => 'Kingspring流量计',
            'parent_id' => $flowmeter->id,
            'type' => 2,
        ]);
    }
}