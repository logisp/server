<?php

use Illuminate\Database\Seeder;

use App\Domain\Facades\Users;
use App\Domain\Facades\Admins;
use App\Domain\Facades\Points;

class AccountSeeder extends Seeder
{
	public function run()
	{
		$username = env('ROOT_USERNAME');
		$password = env('ROOT_PASSWORD');

		$id = Admins::createRootAdmin($username, $password);
		Users::createEmail($id, $username . '@logisp.com');
		Users::createRootUser($id, $username, $password);
		$data = [];
    for ($i = 0; $i < 700; $i++) {
			$data[] = [
				'user_id' => $id,
				'type' => 'purchase',
				'increments' => random_int(10, 100) * 100
			];
		}
		Points::log($data);
		$data = [];
    for ($i = 0; $i < 500; $i++) {
			$data[] = [
				'user_id' => $id,
				'order_id' => 0,
				'type' => 'consumption.test',
				'increments' => random_int(10, 100) * 100
			];
		}
		Points::log($data);
    for ($i = 0; $i < 300; $i++) {
			$data[] = [
				'user_id' => $id,
				'admin_id' => $id,
				'type' => 'adjustment',
				'increments' => random_int(10, 100) * 100
			];
		}
		Points::log($data);
	}
}
