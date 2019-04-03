<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersTableCreate extends Migration
{
	public function up()
	{
		Schema::create('users', function ($table) {
			$table->integer('id')->primary();

			$table->boolean('is_dropped')->default(false);
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('dropped_at')->nullable();

			$table->string('username')->nullable()->unique();
			$table->string('password');
			$table->jsonb('roles')->default('[]');

			// $table->string('first_name')->nullable();
			// $table->string('second_name')->nullable();

			$table->integer('points')->default(0);
			$table->jsonb('cart_ids')->default('[]');

			$table->string('name')->default('');
			$table->string('mobile')->default('');
			$table->string('zipcode')->default('');
			$table->string('address')->default('');
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}
