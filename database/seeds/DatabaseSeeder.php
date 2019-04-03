<?php

use Illuminate\Database\Seeder;

use App\Domain\Facades\Fees;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		$this->call(FeeSeeder::class);
		$this->call(SeriesSeeder::class);
		$this->call(AccountSeeder::class);
	}
}
