<?php

namespace App\Http\Controllers;

use DB;
use JWT;
use Auth;
use Transaction;
use App\Domain\Facades\Users;
use App\Domain\Facades\Admins;

class AuthController extends Controller
{
	public function generateUserTokenByEmail()
	{
		$address = $this->get('address', 'required');
		$password = $this->get('password', 'required');

		$result = false;
		$user = Users::findByEmail($address);
		if ($user) {
			$result = Users::matchPassword($user->id, $password);
		}

		if (!$result) {
			return $this->fail([
				'message' => 'fail_to_generate_user_token'
			], 400);
		} else {
			$token = JWT::encode([
				'aud' => 'user',
				'id' => $user->id
			]);

			return $this->success([
				'message' => 'success_to_generate_user_token',
				'token' => $token
			]);
		}
	}

	public function generateAdminTokenByUsername()
	{
		$username = $this->get('username', 'required');
		$password = $this->get('password', 'required');

		$result = false;
		$admin = Admins::findByUsername($username);
		if ($admin) {
			$result = Admins::matchPassword($admin->id, $password);
		}

		if (!$result) {
			return $this->fail([
				'message' => 'fail_to_generate_admin_token'
			], 400);
		} else {
			$data = [
				'aud' => 'admin',
				'id' => $admin->id
			];

			return $this->success([
				'message' => 'success_to_generate_admin_token',
				'token' => JWT::encode($data)
			]);
		}
	}

	public function checkToken()
	{
		$token = JWT::isNeedToRefresh() ? JWT::refresh() : '';

		return [
			'token' => $token,
			'system' => Auth::tokenData()->aud,
			'account' => Auth::account()
		];
	}

	public function checkRootRole()
	{
		return $this->success('role_is_valid', 200);
	}
}
