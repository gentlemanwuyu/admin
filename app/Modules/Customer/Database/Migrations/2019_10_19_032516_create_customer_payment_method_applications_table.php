<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerPaymentMethodApplicationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_payment_method_applications', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('customer_id')->default(0)->comment('客户ID');
			$table->integer('method_id')->default(0)->comment('付款方式ID');
			$table->decimal('limit_amount', 8, 2)->default(0.00)->comment('额度');
			$table->smallInteger('monthly_day')->default(0)->comment('月结天数');
			$table->text('message')->default('')->comment('申请内容');
			$table->integer('user_id')->default(0)->comment('申请人ID');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('创建时间');
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('最后更新时间');
			$table->index('customer_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('customer_payment_method_applications');
	}
}
