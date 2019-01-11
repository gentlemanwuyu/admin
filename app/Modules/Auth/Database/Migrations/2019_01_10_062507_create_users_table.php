<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->default('')->comment('用户名');
			$table->string('email')->default('')->comment('邮箱地址')->unique();
			$table->string('password')->default('')->comment('密码');
			$table->date('birthday')->comment('生日');
			$table->enum('gender',[0, 1, 2])->default(0)->comment('性别，1为男，2为女');
			$table->string('telephone', 32)->default('')->comment('电话');
			$table->rememberToken();
			$table->enum('is_admin',[0, 1])->default(0)->comment('是否为管理员账号');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('创建时间');
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('最后更新时间');
			$table->timestamp('deleted_at')->nullable()->comment('删除时间');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}
}
