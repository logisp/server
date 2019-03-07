<?php

namespace App\Http\Middleware;

use JWT;
use Auth as AuthService;
use Closure;
use App\Domain\Facades\Users;
use App\Domain\Facades\admins;

class Auth
{
	public $account;

	public $tokenData;

	public $system = null;

	public function handle($request, Closure $next, $system = null, $role = null)
	{
		$token = request()->header('authorization');
		$tokenData = JWT::parse($token);
		if (!$tokenData) {
			return error_response('token_is_invalid', 403);
		}

		if (!$this->checkSystem($tokenData->sys, $system)) {
			return error_response('invalid_system_token', 403);
		};

		$account = $this->getAccount($tokenData->id, $tokenData->sys);
		if (!$account) {
			return error_response('invalid_system_account', 403);
		}

		if (!$this->checkRole($account->roles, $role)) {
			return error_response('invalid_role', 403);
		}

		AuthService::setSystem($system);
		AuthService::setAccount($account);

		return $next($request);
	}

	private function checkSystem($sys, $system)
	{
		if (!$system) return true;

		return $sys === $system;
	}

	private function checkRole($roles, $role)
	{
		if (!$role) return true;

		return in_array($role, $roles);
	}

	private function getAccount($id, $sys)
	{
		$account = null;

		if ($sys === 'user') {
			$account = Users::findById($id);
		} else if ($sys === 'admin') {
			$account = Admins::findById($id);
		}

		return $account;
	}
}
