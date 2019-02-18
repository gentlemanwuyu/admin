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
use App\Modules\Entrust\Models\Role;

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
        /**
         * --------------------------------------------------
         * permissions表填充数据
         * --------------------------------------------------
         */
        // 用户列表
        $p_user_list = Permission::create([
            'name' => 'user_list',
            'display_name' => 'User List',
            'type_id' => 1,
        ]);
        // 角色列表
        $p_role_list = Permission::create([
            'name' => 'role_list',
            'display_name' => 'Role List',
            'type_id' => 1,
        ]);
        // 权限列表
        $p_permission_list = Permission::create([
            'name' => 'permission_list',
            'display_name' => 'Permission List',
            'type_id' => 1,
        ]);
        // 部门结构图
        $p_department_chart = Permission::create([
            'name' => 'department_chart',
            'display_name' => 'Department chart',
            'type_id' => 1,
        ]);
        // 添加用户
        $p_add_user = Permission::create([
            'name' => 'add_user',
            'display_name' => 'Add user',
            'type_id' => 2,
        ]);
        // 编辑用户
        $p_edit_user = Permission::create([
            'name' => 'edit_user',
            'display_name' => 'Edit user',
            'type_id' => 2,
        ]);
        // 删除用户
        $p_delete_user = Permission::create([
            'name' => 'delete_user',
            'display_name' => 'Delete user',
            'type_id' => 2,
        ]);
        // 添加角色
        $p_add_role = Permission::create([
            'name' => 'add_role',
            'display_name' => 'Add role',
            'type_id' => 2,
        ]);
        // 修改角色
        $p_edit_role = Permission::create([
            'name' => 'edit_role',
            'display_name' => 'Edit role',
            'type_id' => 2,
        ]);
        // 删除角色
        $p_delete_role = Permission::create([
            'name' => 'delete_role',
            'display_name' => 'Delete role',
            'type_id' => 2,
        ]);
        // 添加权限
        $p_add_permission = Permission::create([
            'name' => 'add_permission',
            'display_name' => 'Add permission',
            'type_id' => 2,
        ]);
        // 修改权限
        $p_edit_permission = Permission::create([
            'name' => 'edit_permission',
            'display_name' => 'Edit permission',
            'type_id' => 2,
        ]);
        // 删除权限
        $p_delete_permission = Permission::create([
            'name' => 'delete_permission',
            'display_name' => 'Delete permission',
            'type_id' => 2,
        ]);

        // 添加部门
        $p_add_department = Permission::create([
            'name' => 'add_department',
            'display_name' => 'Add department',
            'type_id' => 2,
        ]);
        // 修改部门
        $p_edit_department = Permission::create([
            'name' => 'edit_department',
            'display_name' => 'Edit department',
            'type_id' => 2,
        ]);
        // 删除部门
        $p_delete_department = Permission::create([
            'name' => 'delete_department',
            'display_name' => 'Delete department',
            'type_id' => 2,
        ]);
        // 拖动部门
        $p_drag_department = Permission::create([
            'name' => 'drag_department',
            'display_name' => 'Drag department',
            'type_id' => 2,
        ]);


        /**
         * --------------------------------------------------
         * roles表填充数据
         * --------------------------------------------------
         */
        // 用户管理者
        $r_user_manager = Role::create([
            'name' => 'user_manager',
            'display_name' => 'User manager',
        ]);
        $r_user_manager->perms()->sync([
            $p_user_list->id,
            $p_add_user->id,
            $p_edit_user->id,
            $p_delete_user->id,
        ]);
        // 权限管理者
        $r_entrust_manager = Role::create([
            'name' => 'entrust_manager',
            'display_name' => 'Entrust manager',
        ]);
        $r_entrust_manager->perms()->sync([
            $p_permission_list->id,
            $p_add_permission->id,
            $p_edit_permission->id,
            $p_delete_permission->id,
            $p_role_list->id,
            $p_add_role->id,
            $p_edit_role->id,
            $p_delete_role->id,
        ]);
        // 部门管理者
        $r_department_manager = Role::create([
            'name' => 'department_manager',
            'display_name' => 'Department manager',
        ]);
        $r_department_manager->perms()->sync([
            $p_department_chart->id,
            $p_add_department->id,
            $p_edit_department->id,
            $p_delete_department->id,
            $p_drag_department->id,
        ]);
    }
}