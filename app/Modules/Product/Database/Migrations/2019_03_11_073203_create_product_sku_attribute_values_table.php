<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSkuAttributeValuesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_sku_attribute_values', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->default(0)->comment('产品ID');
			$table->integer('sku_id')->default(0)->comment('Sku ID');
			$table->integer('attribute_id')->default(0)->comment('属性ID');
			$table->string('value')->default('')->comment('属性值');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('创建时间');
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('最后更新时间');

			$table->index(['sku_id', 'attribute_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('product_sku_attribute_values');
	}
}
