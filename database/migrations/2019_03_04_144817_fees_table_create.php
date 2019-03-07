<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FeesTableCreate extends Migration
{
	public function up()
	{
		Schema::create('fees', function ($table) {
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('comment')->nullable();
			$table->integer('points');
		});
	}

	public function down()
	{
		Schema::dropIfExists('fees');
	}
}
