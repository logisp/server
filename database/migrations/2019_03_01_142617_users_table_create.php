<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersTableCreate extends Migration
{
	public function up()
	{
		Schema::create('users', function ($table) {
			$table->increments('id');

			$table->boolean('is_dropped')->default(false);

			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('dropped_at')->nullable();

			$table->string('username')->nullable()->unique();
			$table->string('password');
			$table->jsonb('roles')->default('[]');

			$table->integer('points')->default(0);

			$table->string('first_name')->nullable();
			$table->string('second_name')->nullable();
		});

		// DB::statement("ALTER TABLE \"users\" ADD COLUMN roles integer[] DEFAULT '{}'");
	}

	public function down()
	{
		Schema::dropIfExists('users');
	}
}
