<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserPointLogsTableCreate extends Migration
{
	public function up()
	{
		Schema::create('user_point_logs', function ($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('type');
			$table->timestamp('created_at')->useCurrent();
			$table->integer('order_id')->nullable();
			$table->integer('admin_id')->nullable();
			$table->integer('increments');
			$table->string('comment')->nullable();
		});
	}

	public function down()
	{
		Schema::dropIfExists('user_point_logs');
	}
}
