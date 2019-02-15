<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/2/11
 * Time: 17:51
 */

namespace App\Modules\Entrust\Console;

use Illuminate\Console\Command;
use App\Modules\Entrust\Models\Permission;

class InitializeEntrust extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entrust:initialize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize data of several tables that are related to entrust';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->permissionsSeeder();
    }

    /**
     * permissions表填充数据
     */
    public function permissionsSeeder()
    {
        /**
         * --------------------------------------------------
         * Menu权限
         * --------------------------------------------------
         */
        // 用户列表
        Permission::create([
            'name' => 'user_list',
            'display_name' => 'User List',
            'type_id' => 1,
        ]);
        // 角色列表
        Permission::create([
            'name' => 'role_list',
            'display_name' => 'Role List',
            'type_id' => 1,
        ]);
        // 权限列表
        Permission::create([
            'name' => 'permission_list',
            'display_name' => 'Permission List',
            'type_id' => 1,
        ]);
        // 部门结构图
        Permission::create([
            'name' => 'department_chart',
            'display_name' => 'Department chart',
            'type_id' => 1,
        ]);


        /**
         * --------------------------------------------------
         * action权限
         * --------------------------------------------------
         */
        // 添加用户
        Permission::create([
            'name' => 'add_user',
            'display_name' => 'Add user',
            'type_id' => 2,
        ]);
        // 编辑用户
        Permission::create([
            'name' => 'edit_user',
            'display_name' => 'Edit user',
            'type_id' => 2,
        ]);
        // 删除用户
        Permission::create([
            'name' => 'delete_user',
            'display_name' => 'Delete user',
            'type_id' => 2,
        ]);

        // 添加权限
        Permission::create([
            'name' => 'add_permission',
            'display_name' => 'Add permission',
            'type_id' => 2,
        ]);
        // 修改权限
        Permission::create([
            'name' => 'edit_permission',
            'display_name' => 'Edit permission',
            'type_id' => 2,
        ]);
        // 删除权限
        Permission::create([
            'name' => 'delete_permission',
            'display_name' => 'Delete permission',
            'type_id' => 2,
        ]);

        // 添加部门
        Permission::create([
            'name' => 'add_department',
            'display_name' => 'Add department',
            'type_id' => 2,
        ]);
        // 修改部门
        Permission::create([
            'name' => 'edit_department',
            'display_name' => 'Edit department',
            'type_id' => 2,
        ]);
        // 删除部门
        Permission::create([
            'name' => 'delete_department',
            'display_name' => 'Delete department',
            'type_id' => 2,
        ]);
        // 拖动部门
        Permission::create([
            'name' => 'drag_department',
            'display_name' => 'Drag department',
            'type_id' => 2,
        ]);
    }
}