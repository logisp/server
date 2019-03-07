<?php

use Illuminate\Database\Seeder;

use App\Domain\Facades\Fees;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		$this->call(TestAccountSeeder::class);
		$this->insertTestFees();
	}

	public function insertTestFees()
	{
    for ($i = 1; $i < 10; $i++) {
      $name = 'test_fee_' . $i;
      $points = random_int(1, 10) * 1000;
      $comment = 'test_fee_comment_' . $i;

      Fees::create($name, $points, $comment);
    }
	}
}
