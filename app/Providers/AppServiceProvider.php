<?php

namespace App\Providers;

use DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Query\Builder;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{

	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->macroBuilderMiniPaginate();
	}

	private function macroBuilderMiniPaginate()
	{
		Builder::macro('miniPaginate', function ($page = null, $perPage = null) {
			!$page && ($page = request('page'));
			!$perPage && ($perPage = request('pageSize'));
			!$page && ($page = 1);
			!$perPage && ($perPage = 15);

			$total = $this->getCountForPagination();
			$data = $total ? $this->forPage($page, $perPage)->get() : collect();

			return [
				'page' => $page,
				'pageSize' => $perPage,
				'total' => $total,
				'data' => $data
			];
		});
	}
}
