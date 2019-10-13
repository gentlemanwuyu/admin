<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('suppliers', function (Blueprint $table) {
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
			$table->enum('is_black', [1, 2])->default(1)->comment('是否拉黑, 1为否，2为是');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('创建时间');
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('最后更新时间');
			$table->timestamp('deleted_at')->nullable()->comment('删除时间');
			$table->unique('name');
			$table->index('code');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('suppliers');
	}
}
