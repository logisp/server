<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdersTableCreate extends Migration
{
	public function up()
	{
		Schema::create('orders', function ($table) {
			$table->increments('id');
			$table->enum('status', [
				'inbounding', 'inbounded', 'confirming', 'confirmed',
				'produced', 'unexpected', 'abandoning', 'abandoned',
				'outbounding', 'outbounded', 'filed', 'deleted'
			])->default('inbounding');
			$table->string('outbound_method')->default('amazon');
			$table->string('is_to_produce_on_amazon')->default(false);

			$table->string('inbounding_logistic_inc')->nullable();
			$table->string('inbounding_logistic_id')->nullable();
			$table->string('asin')->nullable();
			$table->string('sku')->nullable();
			$table->string('snsku')->nullable();
		});
	}

	public function down()
	{
		Schema::dropIfExists('orders');
	}
}
