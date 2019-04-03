<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IndividualOutboundsTableCreate extends Migration
{
	public function up()
	{
		Schema::create('individual_outbounds', function ($table) {
			$table->increments('id');
			$table->integer('order_id');

			$table->timestamp('created_at')->useCurrent();
		});
	}

	public function down()
	{
		Schema::drop('individual_outbounds');
	}
}
