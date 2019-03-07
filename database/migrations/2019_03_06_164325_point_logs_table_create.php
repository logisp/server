<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PointLogsTableCreate extends Migration
{
	public function up()
	{
		Schema::create('point_logs', function ($table) {
			$table->integer('order_id');
			$table->integer('admin_id')->nullable();

			$table->timestamp('created_at')->useCurrent();

			$table->string('module');
			$table->string('method');

			$table->integer('increments');

			$table->string('comment')->nullable();
		});
	}

	public function down()
	{
		Schema::dropIfExists('point_logs');
	}
}
