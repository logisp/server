<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FeeLogsTableCreate extends Migration
{
	public function up()
	{
		Schema::create('fee_logs', function ($table) {
			$table->string('name')->index();
			$table->timestamp('created_at')->useCurrent();
			$table->integer('admin_id');
			$table->double('points');
			$table->string('comment')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('fee_logs');
	}
}
