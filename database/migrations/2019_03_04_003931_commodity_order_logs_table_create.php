<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CommodityOrderLogsTableCreate extends Migration
{
	public function up()
	{
		Schema::create('commodity_order_logs', function ($table) {
			$table->integer('commodity_order_id');
			$table->integer('admin_id')->nullable();

			$table->timestamp('created_at')->useCurrent();

			$table->string('method');
			$table->string('comment')->nullable();
		});
	}

	public function down()
	{
		Schema::dropIfExists('commodity_order_logs');
	}
}
