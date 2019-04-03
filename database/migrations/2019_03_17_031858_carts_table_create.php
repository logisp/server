<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CartsTableCreate extends Migration
{
	public function up()
	{
		Schema::create('carts', function ($table) {
			$table->bigInteger('id')->primary();

			$table->boolean('is_to_produce_on_amazon')->default(false);
			$table->boolean('is_to_check_appendant')->default(false);
			$table->boolean('is_to_check')->default(false);
			$table->boolean('is_to_clean')->default(false);
			$table->boolean('is_to_repack')->default(false);

			$table->string('outbound_method')->default('amazon');
			$table->string('asin')->nullable();
			$table->string('sku')->nullable();
			$table->string('description')->nullable();
			$table->string('usage_degree')->default('new');
			$table->string('amazon_good_id')->nullable();

			$table->double('buying_price')->nullable();
			$table->double('selling_price')->nullable();
			$table->double('origin_price')->nullable();
			$table->integer('shooting_quantity')->default(0);
			$table->string('repack_remark')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('carts');
	}
}
