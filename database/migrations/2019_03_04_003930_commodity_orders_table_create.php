<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CommodityOrdersTableCreate extends Migration
{
	public function up()
	{
		Schema::create('commodity_orders', function ($table) {
			$table->increments('id');
			$table->integer('user_id');

			$table->boolean('is_inbound')->default(false);
			$table->boolean('is_discrepant')->default(false);
			$table->boolean('is_abandoning')->default(false);
			$table->boolean('is_abandoned')->default(false);
			$table->boolean('is_outbound')->default(false);
			$table->boolean('is_created_in_amazon')->default(false);

			$table->boolean('is_to_abandon')->default(false);
			$table->boolean('is_to_create_in_amazon')->default(false);
			$table->boolean('is_to_update_discrepant')->default(false);

			// $table->boolean('is_filed')->default(false);
			// $table->boolean('is_deleted')->default(false);
			$table->boolean('is_abandoned_confirming')->default(false);//
			$table->boolean('is_discrepant_confirming')->default(false);//

			$table->timestamp('created_at')->useCurrent();
			// $table->timestamp('inbound_at')->nullable();
			// $table->timestamp('outbound_at')->nullable();
			// $table->timestamp('filed_at')->nullable();

			$table->string('outbound_method');

			$table->string('inbound_logistic_id')->nullable();
			$table->string('name')->nullable();
			$table->string('comment')->nullable();
			$table->string('discription')->nullable();
		});
	}

	public function down()
	{
		Schema::dropIfExists('commodity_orders');
	}
}
