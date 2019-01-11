<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/10
 * Time: 19:53
 */

namespace App\Modules\Auth\Database\Seeds;

use App\Modules\Auth\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        module_factory('Auth', User::class, 30)->create();
    }
}