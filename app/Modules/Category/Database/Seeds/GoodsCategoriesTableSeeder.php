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
            'name' => '卧式液位开关',
            'display_name' => '卧式液位开关',
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
    }
}