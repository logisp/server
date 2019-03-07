<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PointOrdersTableCreate extends Migration
{
	public function up()
	{
		Schema::create('point_orders', function ($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('admin_id')->nullable();
			$table->integer('confirmer_id')->nullable();

			$table->boolean('is_filed')->default(false);
			$table->boolean('is_passed')->default(false);
			$table->boolean('is_recorded')->default(false);
			$table->boolean('is_confirming')->default(false);

			$table->timestamp('filed_at')->nullable();
			$table->timestamp('passed_at')->nullable();
			$table->timestamp('recorded_at')->nullable();
			$table->timestamp('created_at')->useCurrent();

			$table->integer('points');
		});
	}

	public function down()
	{
		Schema::dropIfExists('point_orders');
	}
}
