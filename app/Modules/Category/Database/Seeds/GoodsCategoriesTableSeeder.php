<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/7
 * Time: 19:39
 */

namespace App\Modules\Category\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Modules\Category\Models\GoodsCategory;

class GoodsCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        // 压力表
        $pressure_meter = GoodsCategory::create([
            'name' => '压力表',
            'display_name' => '压力表',
        ]);
        GoodsCategory::create([
            'name' => '不锈钢压力表',
            'display_name' => '不锈钢压力表',
            'parent_id' => $pressure_meter->id,
        ]);
        GoodsCategory::create([
            'name' => 'PP压力表',
            'display_name' => 'PP压力表',
            'parent_id' => $pressure_meter->id,
        ]);

        // 液位开关
        $level_switch = GoodsCategory::create([
            'name' => '液位开关',
            'display_name' => '液位开关',
        ]);
        $vertical_switch = GoodsCategory::create([
            'name' => '立式液位开关',
            'display_name' => '立式液位开关',
            'parent_id' => $level_switch->id,
        ]);
        GoodsCategory::create([
            'name' => 'PP立式液位开关',
            'display_name' => 'PP立式液位开关',
            'parent_id' => $vertical_switch->id,
        ]);
        GoodsCategory::create([
            'name' => 'PVDF立式液位开关',
            'display_name' => 'PVDF立式液位开关',
            'parent_id' => $vertical_switch->id,
        ]);
        GoodsCategory::create([
            'name' => '304立式液位开关',
            'display_name' => '304立式液位开关',
            'parent_id' => $vertical_switch->id,
        ]);
        $horizontal_switch = GoodsCategory::create([
            'name' => '卧式液位开关',
            'display_name' => '卧式液位开关',
            'parent_id' => $level_switch->id,
        ]);
        GoodsCategory::create([
            'name' => 'PP卧式液位开关',
            'display_name' => 'PP卧式液位开关',
            'parent_id' => $horizontal_switch->id,
        ]);
        GoodsCategory::create([
            'name' => 'PVDF卧式液位开关',
            'display_name' => 'PVDF卧式液位开关',
            'parent_id' => $horizontal_switch->id,
        ]);
        GoodsCategory::create([
            'name' => '304卧式液位开关',
            'display_name' => '304卧式液位开关',
            'parent_id' => $horizontal_switch->id,
        ]);

        // 滚轮片
        $disk = GoodsCategory::create([
            'name' => '滚轮片',
            'display_name' => '滚轮片',
        ]);
        GoodsCategory::create([
            'name' => 'PP滚轮片',
            'display_name' => 'PP滚轮片',
            'parent_id' => $disk->id,
        ]);
        GoodsCategory::create([
            'name' => '包胶滚轮片',
            'display_name' => '包胶滚轮片',
            'parent_id' => $disk->id,
        ]);
        GoodsCategory::create([
            'name' => '耐高温滚轮片',
            'display_name' => '耐高温滚轮片',
            'parent_id' => $disk->id,
        ]);
        GoodsCategory::create([
            'name' => 'LCD收板机滚轮片',
            'display_name' => 'LCD收板机滚轮片',
            'parent_id' => $disk->id,
        ]);

        // 连接套
        GoodsCategory::create([
            'name' => '连接套',
            'display_name' => '连接套',
        ]);

        // 插件
        GoodsCategory::create([
            'name' => '插件',
            'display_name' => '插件',
        ]);

        // 齿轮
        $gear = GoodsCategory::create([
            'name' => '齿轮',
            'display_name' => '齿轮',
        ]);
        GoodsCategory::create([
            'name' => '直齿轮',
            'display_name' => '直齿轮',
            'parent_id' => $gear->id,
        ]);
        GoodsCategory::create([
            'name' => '伞齿轮',
            'display_name' => '伞齿轮',
            'parent_id' => $gear->id,
        ]);
        GoodsCategory::create([
            'name' => '钉齿轮',
            'display_name' => '钉齿轮',
            'parent_id' => $gear->id,
        ]);
        GoodsCategory::create([
            'name' => '螺旋齿轮',
            'display_name' => '螺旋齿轮',
            'parent_id' => $gear->id,
        ]);
        GoodsCategory::create([
            'name' => '组合齿轮',
            'display_name' => '组合齿轮',
            'parent_id' => $gear->id,
        ]);

        // 喷咀喷管
        $nozzle = GoodsCategory::create([
            'name' => '喷咀喷管',
            'display_name' => '喷咀喷管',
        ]);
        GoodsCategory::create([
            'name' => '喷管',
            'display_name' => '喷管',
            'parent_id' => $nozzle->id,
        ]);
        GoodsCategory::create([
            'name' => '喷咀',
            'display_name' => '喷咀',
            'parent_id' => $nozzle->id,
        ]);
        GoodsCategory::create([
            'name' => '喷嘴芯',
            'display_name' => '喷嘴芯',
            'parent_id' => $nozzle->id,
        ]);

        // 异型材
        $profile_bar = GoodsCategory::create([
            'name' => '异型材',
            'display_name' => '异型材',
        ]);
        GoodsCategory::create([
            'name' => '拉手',
            'display_name' => '拉手',
            'parent_id' => $profile_bar->id,
        ]);
        GoodsCategory::create([
            'name' => '水泵过滤器配件',
            'display_name' => '水泵过滤器配件',
            'parent_id' => $profile_bar->id,
        ]);

        // 滚轮
        $roller = GoodsCategory::create([
            'name' => '滚轮',
            'display_name' => '滚轮',
        ]);
        GoodsCategory::create([
            'name' => '行辘',
            'display_name' => '行辘',
            'parent_id' => $roller->id,
        ]);
        GoodsCategory::create([
            'name' => '压辘',
            'display_name' => '压辘',
            'parent_id' => $roller->id,
        ]);

        // 轴心
        $axis = GoodsCategory::create([
            'name' => '轴心',
            'display_name' => '轴心',
        ]);
        GoodsCategory::create([
            'name' => '玻纤棒',
            'display_name' => '玻纤棒',
            'parent_id' => $axis->id,
        ]);
        GoodsCategory::create([
            'name' => '碳纤棒',
            'display_name' => '碳纤棒',
            'parent_id' => $axis->id,
        ]);
        GoodsCategory::create([
            'name' => '304不锈钢棒',
            'display_name' => '304不锈钢棒',
            'parent_id' => $axis->id,
        ]);
        GoodsCategory::create([
            'name' => '316不锈钢棒',
            'display_name' => '316不锈钢棒',
            'parent_id' => $axis->id,
        ]);

        // 流量计
        $flowmeter = GoodsCategory::create([
            'name' => '流量计',
            'display_name' => '流量计',
        ]);
        GoodsCategory::create([
            'name' => '国产流量计',
            'display_name' => '国产流量计',
            'parent_id' => $flowmeter->id,
        ]);
        GoodsCategory::create([
            'name' => '加强型流量计',
            'display_name' => '加强型流量计',
            'parent_id' => $flowmeter->id,
        ]);
        GoodsCategory::create([
            'name' => 'Kingspring流量计',
            'display_name' => 'Kingspring流量计',
            'parent_id' => $flowmeter->id,
        ]);
    }
}