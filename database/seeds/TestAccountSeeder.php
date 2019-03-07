<?php

use Illuminate\Database\Seeder;

use App\Domain\Facades\Users;
use App\Domain\Facades\Admins;

class TestAccountSeeder extends Seeder
{
	public function run()
	{
		Users::createRootUser();
		Users::createRootEmail('delylaric@gmail.com');
		Admins::createRootAdmin();
	}
}
