<?php

namespace App\Http\Middleware;

use Closure;

class Test
{
	public function handle($request, Closure $next)
	{
    if (!env('APP_TEST')) {
      return error_response('invalid_test_environment');
    }

    return $next($request);
  }
}
