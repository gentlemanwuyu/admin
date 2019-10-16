<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->default('')->comment('名称');
			$table->string('code')->default('')->comment('编号');
			$table->string('company')->default('')->comment('公司名称');
			$table->text('introduction')->default('')->comment('简介');
			$table->string('phone_number')->default('')->comment('电话号码');
			$table->string('fax')->default('')->comment('传真');
			$table->char('country_code', 2)->default('')->comment('国家');
			$table->integer('state_id')->default(0)->comment('省/洲');
			$table->integer('city_id')->default(0)->comment('市');
			$table->integer('county_id')->default(0)->comment('区/县');
			$table->string('street_address')->default('')->comment('街道地址');
			$table->string('address')->default('')->comment('地址');
			$table->integer('manager_id')->default(0)->comment('经理人ID');
			$table->enum('is_black', [1, 2])->default(1)->comment('是否拉黑, 1为否，2为是');
			$table->integer('group_id')->default(0)->comment('集团ID');
			$table->enum('is_master', [1, 2])->default(1)->comment('是否为总公司, 1为是，2为否');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('创建时间');
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('最后更新时间');
			$table->timestamp('deleted_at')->nullable()->comment('删除时间');
			$table->unique('name');
			$table->unique('code');
			$table->index(['country_code', 'state_id', 'city_id', 'county_id']);
			$table->index('manager_id');
			$table->index('group_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('customers');
	}
}
