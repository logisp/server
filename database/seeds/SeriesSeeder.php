<?php

use App\Domain\Facades\Series;
use Illuminate\Database\Seeder;

class SeriesSeeder extends Seeder
{
	public function run()
	{
		Series::create('test');
		Series::create('admin_id', 10000, 1, 1);
		Series::create('user_id', 131500000);
		Series::create('cart_id', 100000000000);
		Series::create('order_id', 100000000000);
	}
}
