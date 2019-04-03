<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserAdminsTableCreate extends Migration
{
	public function up()
	{
		Schema::create('user_admins', function ($table) {
			$table->integer('id');

			$table->boolean('is_dropped')->default(false);

			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('dropped_at')->nullable();

			$table->string('email')->unique()->nullable();
			$table->string('username')->unique();
			$table->string('password');
			$table->jsonb('roles')->default('[]');

			$table->string('first_name')->nullable();
			$table->string('second_name')->nullable();
		});

		// DB::statement("ALTER TABLE \"user_admins\" ADD COLUMN roles integer[] DEFAULT '{}'");
	}

	public function down()
	{
		Schema::drop('user_admins');
	}
}
