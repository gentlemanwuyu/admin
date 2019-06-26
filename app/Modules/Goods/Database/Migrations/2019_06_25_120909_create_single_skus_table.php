<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSingleSkusTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('single_skus', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('goods_id')->default(0)->comment('商品ID');
			$table->integer('product_sku_id')->default(0)->comment('产品skuID');
			$table->string('code')->default('')->comment('sku编号');
			$table->decimal('lowest_price', 8, 2)->default(0.00)->comment('最低售价');
			$table->decimal('msrp', 8, 2)->default(0.00)->comment('建议零售价');
			$table->tinyInteger('enabled')->default(0)->comment('是否可用，0为不可用（禁售），1为可用');
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
		Schema::dropIfExists('single_skus');
	}
}
