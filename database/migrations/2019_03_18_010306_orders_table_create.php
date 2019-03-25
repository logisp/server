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
			$table->integer('user_id');
			$table->enum('status', [
				'posting', 'inbounding', 'inbounded',
				'confirmed', 'unexcepted', 'confirming',
				'abandoning', 'filed'
			])->default('posting');
			$table->enum('outbound_method', [
				'amazon', 'individual', 'abandon'
			])->default('amazon');
			$table->boolean('is_unexpected_inbounded')->default(false);
			$table->boolean('is_unexpected_confirmed')->default(false);
			$table->boolean('is_produced_on_amazon')->default(false);
			$table->boolean('is_abandoned')->default(false);
			$table->boolean('is_to_produce_on_amazon')->default(false);
			$table->boolean('is_to_check_appendant')->default(false);
			$table->boolean('is_to_repack')->default(false);
			$table->boolean('is_to_check')->default(false);
			$table->boolean('is_to_clean')->default(false);
			$table->timestamp('outbounded_at')->nullable();
			$table->timestamp('inbounded_at')->nullable();
			$table->timestamp('created_at')->useCurrent();
			$table->string('unexpected_remark')->nullable();
			$table->string('appendant_remark')->nullable();
			$table->string('checked_remark')->nullable();
			$table->string('inbound_remark')->nullable();
			$table->string('repack_remark')->nullable();
			$table->string('admin_remark')->nullable();
			$table->string('user_remark')->nullable();
			$table->string('logistic_inc')->nullable();
			$table->string('logistic_id')->nullable();
			$table->string('asin')->nullable();
			$table->string('sku')->nullable();
			$table->string('description')->nullable();
			$table->string('usage_degree')->default('new');
			$table->string('amazon_good_id')->nullable();
			$table->double('buying_price')->nullable();
			$table->double('selling_price')->nullable();
			$table->double('origin_price')->nullable();
			$table->integer('shooting_quantity')->default(0);
		});
	}

	public function down()
	{
		Schema::dropIfExists('orders');
	}
}
