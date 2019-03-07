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
            'name' => '卧式液位开关',
            'display_name' => '卧式液位开关',
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
    }
}