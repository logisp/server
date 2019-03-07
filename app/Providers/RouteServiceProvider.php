<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
	/**
	 * This namespace is applied to your controller routes.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @return void
	 */
	public function boot()
	{
		//

		parent::boot();
	}

	/**
	 * Define the routes for the application.
	 *
	 * @return void
	 */
	public function map()
	{
		$this->mapOpenRoutes();
		$this->mapFeeRoutes();
		$this->mapUserRoutes();
		$this->mapPointRoutes();
		$this->mapOrderRoutes();

		if (env('APP_TEST')) {
			$this->mapTestRoutes();
		}
	}

	// /**
	//  * Define the "api" routes for the application.
	//  *
	//  * These routes are typically stateless.
	//  *
	//  * @return void
	//  */
	// protected function mapApiRoutes()
	// {
	//     Route::middleware(['auth'])
	//          ->namespace($this->namespace)
	//          ->group(base_path('routes/api.php'));
	// }

	protected function mapTestRoutes()
	{
		Route::namespace($this->namespace)
			->group(base_path('routes/http/test.php'));
	}

	protected function mapOpenRoutes()
	{
		Route::namespace($this->namespace)
			->group(base_path('routes/http/open.php'));
	}

	protected function mapFeeRoutes()
	{
		Route::namespace($this->namespace)
			->group(base_path('routes/http/fees.php'));
	}

	protected function mapUserRoutes()
	{
		Route::namespace($this->namespace)
			->group(base_path('routes/http/users.php'));
	}

	protected function mapPointRoutes()
	{
		Route::namespace($this->namespace)
			->group(base_path('routes/http/points.php'));
	}

	protected function mapOrderRoutes()
	{
		Route::namespace($this->namespace)
			->group(base_path('routes/http/orders.php'));
	}

	// protected function mapPostgresRoutes()
	// {
	//     Route::middleware(['auth', 'postgres'])
	//          ->namespace($this->namespace)
	//          ->group(base_path('routes/postgres.php'));
	// }
}
