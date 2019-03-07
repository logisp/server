<?php

namespace App\Http\Middleware;

use Closure;

class Debug
{
	public function handle($request, Closure $next)
	{
    if (!env('APP_DEBUG')) {
      return error_response('invalid_debug_environment');
    }

    return $next($request);
  }
}
