<?php

namespace App\Http\Middleware;

use JWT;
use Auth as AuthService;
use Closure;
use App\Domain\Facades\Users;
use App\Domain\Facades\Admins;

class Auth
{
	public function handle($request, Closure $next, $system = null, $role = null)
	{
		$token = request()->header('authorization');
		$payload = JWT::decode($token);
		if (!$this->checkPayload($payload)) {
			return error_response('token_is_invalid', 403);
		}

		$aud = $payload->aud;
		$sub = $payload->sub;
		$account = $this->getAccount($aud, $sub);
		if (!$account) {
			return error_response('account_is_now_invalid', 401);
		}
		// $isRoot = in_array('root', $account->roles);
		if (!$this->checkSystem($sub, $system)) {
			return error_response('account_system_is_invalid', 401);
		}
		if (!$this->checkRole($account->roles, $role)) {
			return error_response('account_role_is_invalid', 401);
		}
		AuthService::setAccount($account);

		return $next($request);
	}

	private function checkPayload($payload)
	{
		return $payload && isset($payload->sub) && isset($payload->aud);
	}

	private function checkSystem($sub, $system)
	{
		if (!$system || $system === 'null') return true;

		return $system === $sub;
	}

	private function getAccount($id, $system)
	{
		if ($system === 'user') {
			return Users::findById($id);
		} else if ($system === 'admin') {
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
