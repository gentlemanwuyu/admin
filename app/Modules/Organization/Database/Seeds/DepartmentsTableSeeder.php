<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/26
 * Time: 15:51
 */

namespace App\Modules\Organization\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Modules\Organization\Models\Department;

class DepartmentsTableSeeder extends Seeder
{
    public function run()
    {
        Department::create([
            'id' => 1,
            'name' => '总经办',
            'parent_id' => 0,
        ]);
        Department::create([
            'id' => 2,
            'name' => '行政人事部',
            'parent_id' => 1,
        ]);
        Department::create([
            'id' => 3,
            'name' => '财务部',
            'parent_id' => 1,
        ]);
        Department::create([
            'id' => 4,
            'name' => '销售部',
            'parent_id' => 1,
        ]);
        Department::create([
            'id' => 5,
            'name' => '仓储中心',
            'parent_id' => 1,
        ]);
        Department::create([
            'id' => 6,
            'name' => '生产部',
            'parent_id' => 1,
        ]);
        Department::create([
            'id' => 7,
            'name' => '行政部',
            'parent_id' => 2,
        ]);
        Department::create([
            'id' => 8,
            'name' => '人事部',
            'parent_id' => 2,
        ]);
        Department::create([
            'id' => 9,
            'name' => '业务部',
            'parent_id' => 4,
        ]);
        Department::create([
            'id' => 10,
            'name' => '商务部',
            'parent_id' => 4,
        ]);
        Department::create([
            'id' => 11,
            'name' => '工模部',
            'parent_id' => 6,
        ]);
        Department::create([
            'id' => 12,
            'name' => '注塑部',
            'parent_id' => 6,
        ]);
        Department::create([
            'id' => 13,
            'name' => '加工部',
            'parent_id' => 6,
        ]);
        Department::create([
            'id' => 14,
            'name' => '业务一部',
            'parent_id' => 9,
        ]);
        Department::create([
            'id' => 15,
            'name' => '业务二部',
            'parent_id' => 9,
        ]);
        Department::create([
            'id' => 16,
            'name' => '业务三部',
            'parent_id' => 9,
        ]);
    }
}