<?php

namespace App\Http\Middleware;

use JWT;
use Auth as AuthService;
use Closure;
use App\Domain\Facades\Users;
use App\Domain\Facades\admins;

class Auth
{
	public function handle($request, Closure $next, $system = null, $role = null)
	{
		$token = request()->header('authorization');
		$tokenData = JWT::decode($token);

		if (!$tokenData) {
			return error_response('token_is_invalid', 403);
		}

		if (!$this->checkSystem($tokenData->aud, $system)) {
			return error_response('invalid_system_token', 403);
		};

		$account = $this->getAccount($tokenData->id, $tokenData->aud);
		if (!$account) {
			return error_response('invalid_system_account', 403);
		}

		if (!$this->checkRole($account->roles, $role)) {
			return error_response('invalid_role', 403);
		}

		AuthService::setSystem($system);
		AuthService::setAccount($account);
		AuthService::setTokenData($tokenData);

		return $next($request);
	}

	private function checkSystem($sys, $system)
	{
		if (!$system) return true;

		return $sys === $system;
	}

	private function getAccount($id, $sys)
	{
		if ($sys === 'user') {
			return Users::findById($id);
		} else if ($sys === 'admin') {
			return Admins::findById($id);
		} else {
			return null;
		}
	}

	private function checkRole($roles, $role)
	{
		if (!$role) return true;

		return in_array($role, $roles);
	}
}
