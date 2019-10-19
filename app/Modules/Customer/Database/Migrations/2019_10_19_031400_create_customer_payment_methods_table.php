<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerPaymentMethodsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_payment_methods', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('customer_id')->default(0)->comment('客户ID');
			$table->integer('method_id')->default(0)->comment('付款方式ID');
			$table->decimal('limit_amount', 8, 2)->default(0.00)->comment('额度');
			$table->unique('customer_id');
			$table->index('method_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('customer_payment_methods');
	}
}
