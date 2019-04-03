<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeriesTableCreate extends Migration
{
	public function up()
	{
		Schema::create('series', function ($table) {
			$table->string('name')->primary();
			// $table->string('comment')->nullable();
			$table->integer('min_step')->default(1);
			$table->integer('max_step')->default(10);
			$table->bigInteger('begin')->default(1);
			$table->bigInteger('value')->default(1);
			$table->bigInteger('count')->default(0);
		});
	}

	public function down()
	{
		Schema::drop('series');
	}
}
