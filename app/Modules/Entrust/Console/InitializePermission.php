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

class InitializePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entrust:initialize_permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize permissions table data';

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
        // 添加用户权限
        Permission::create([
            'name' => 'add_user',
            'display_name' => 'Add user',
            'type_id' => 2,
        ]);
        // 编辑用户权限
        Permission::create([
            'name' => 'edit_user',
            'display_name' => 'Edit user',
            'type_id' => 2,
        ]);
        // 删除用户权限
        Permission::create([
            'name' => 'delete_user',
            'display_name' => 'Delete user',
            'type_id' => 2,
        ]);
    }
}