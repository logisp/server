<?php

use Illuminate\Database\Seeder;

use App\Domain\Facades\Users;
use App\Domain\Facades\Admins;

class AccountSeeder extends Seeder
{
	public function run()
	{
		$username = env('ROOT_USERNAME');
		$password = env('ROOT_PASSWORD');

		$id = Admins::createRootAdmin($username, $password);
		Users::createEmail($id, $username . '@logisp.com');
		Users::createRootUser($id, $username, $password);
	}
}
