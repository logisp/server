<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AmazonOutboundsTableCreate extends Migration
{
	public function up()
	{
		Schema::create('amazon_outbounds', function ($table) {
			$table->increments('id');
			$table->timestamp('created_at')->useCurrent();
		});
	}

	public function down()
	{
		Schema::drop('amazon_outbounds');
	}
}
