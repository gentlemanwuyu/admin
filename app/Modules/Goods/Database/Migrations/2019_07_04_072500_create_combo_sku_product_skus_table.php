<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComboSkuProductSkusTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('combo_sku_product_skus', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('goods_sku_id')->default(0)->comment('商品skuID');
			$table->integer('product_id')->default(0)->comment('产品ID');
			$table->integer('product_sku_id')->default(0)->comment('产品skuID');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('创建时间');
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('最后更新时间');
			$table->timestamp('deleted_at')->nullable()->comment('删除时间');

			$table->index('goods_sku_id');
			$table->index('product_sku_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('combo_sku_product_skus');
	}
}
