<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserCreditCardAccountsTableCreate extends Migration
{
	public function up()
	{
		Schema::create('user_credit_card_accounts', function ($table) {
			$table->string('id');
			$table->string('user_id')->unique();
			$table->string('name');

			$table->boolean('is_verified')->default(false);
			$table->boolean('is_effective')->default(false);

			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('expired_at')->nullable();
			$table->timestamp('effective_at')->nullable();
		});
	}

	public function down()
	{
		Schema::dropIfExists('user_credit_card_accounts');
	}
}
