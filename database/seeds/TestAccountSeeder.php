<?php

use Illuminate\Database\Seeder;

use App\Domain\Facades\Users;
use App\Domain\Facades\Admins;

class TestAccountSeeder extends Seeder
{
	public function run()
	{
		Users::createRootUser(env('ROOT_PASSWORD'));
		Users::createRootEmail(env('ROOT_USER_EMAIL'));
		Admins::createRootAdmin(env('ROOT_PASSWORD'));
	}
}
