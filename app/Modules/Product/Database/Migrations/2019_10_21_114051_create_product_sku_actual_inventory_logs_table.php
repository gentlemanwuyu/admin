<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSkuActualInventoryLogsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_sku_actual_inventory_logs', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('sku_id')->default(0)->comment('产品SkuID');
			$table->integer('ori_stock')->default(0)->comment('原始库存');
			$table->integer('new_stock')->default(0)->comment('最新库存');
			$table->integer('user_id')->default(0)->comment('修改人ID');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('创建时间');
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('最后更新时间');

			$table->index('sku_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('product_sku_actual_inventory_logs');
	}
}
