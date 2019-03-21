<?php

namespace App\Http\Middleware;

use JWT;
use Closure;
use App\Domain\Facades\Users;
use App\Services\Facades\Cart as CartService;

class Auth
{
	public function handle($request, Closure $next, $system = null, $role = null)
	{
		$token = request()->header('authorization');
		$tokenData = JWT::decode($token);
		$isRoot = ($tokenData->id === 0);

		if (!$tokenData) {
			return error_response('token_is_invalid', 403);
		}

		if (!$isRoot && !$this->checkSystem($tokenData->aud, $system)) {
			return error_response('invalid_system_token', 403);
		};

		$account = $this->getAccount($tokenData->id, $tokenData->aud);
		if (!$account) {
			return error_response('system_account_is_not_existed', 403);
		}

		if (!$isRoot && !$this->checkRole($account->roles, $role)) {
			return error_response('invalid_role', 403);
		}

		AuthService::setSystem($system);
		AuthService::setAccount($account);
		AuthService::setTokenData($tokenData);

		return $next($request);
	}
}
