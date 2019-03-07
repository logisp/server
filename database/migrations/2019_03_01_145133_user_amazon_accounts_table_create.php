<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserAmazonAccountsTableCreate extends Migration
{
	public function up()
	{
		Schema::create('user_amazon_accounts', function ($table) {
			$table->string('id');
			$table->string('token');
			$table->integer('user_id')->unique();

			$table->boolean('is_verified')->default(false);

			$table->timestamp('created_at')->useCurrent();
		});
	}

	public function down()
	{
		Schema::dropIfExists('user_amazon_accounts');
	}
}
