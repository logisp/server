<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FeesTableCreate extends Migration
{
	public function up()
	{
		Schema::create('fees', function ($table) {
			$table->double('points');
			$table->string('name')->primary();
			$table->string('comment')->nullable();
		});
	}

	public function down()
	{
		Schema::dropIfExists('fees');
	}
}
