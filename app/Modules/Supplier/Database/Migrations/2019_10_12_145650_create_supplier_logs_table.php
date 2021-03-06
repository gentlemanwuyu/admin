<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierLogsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('supplier_logs', function (Blueprint $table) {
			$table->increments('id');
			$table->string('supplier_id')->default(0)->comment('供应商id');
			$table->tinyInteger('action')->default(0)->comment('操作，1为创建，2为修改，3为拉黑，4为释放，5为删除');
			$table->text('message')->default('')->comment('备注信息');
			$table->integer('user_id')->default(0)->comment('操作人ID');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('创建时间');
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('最后更新时间');
			$table->index('supplier_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('supplier_logs');
	}
}
