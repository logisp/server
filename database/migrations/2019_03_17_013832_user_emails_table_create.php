<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserEmailsTableCreate extends Migration
{
	public function up()
	{
		Schema::create('user_emails', function ($table) {
			$table->bigInteger('user_id')->unique();
			$table->string('address')->unique();
			$table->boolean('is_verified')->default(false);
			// $table->timestamp('created_at')->useCurrent();
		});
	}

	public function down()
	{
		Schema::drop('user_emails');
	}
}
