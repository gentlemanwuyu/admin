<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('goods', function (Blueprint $table) {
			$table->increments('id');
			$table->string('code')->default('')->comment('商品编号');
			$table->string('name')->default('')->comment('商品标题');
			$table->text('description')->default('')->comment('商品描述');
			$table->text('image_link')->default('')->comment('图片链接');
			$table->enum('type',[0, 1, 2])->default(0)->comment('商品类型，1为singgle，2为combo');
			$table->integer('category_id')->default(0)->comment('分类ID');
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
		Schema::dropIfExists('goods');
	}
}
