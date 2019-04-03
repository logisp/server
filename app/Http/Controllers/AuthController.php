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

		$result = Users::matchPasswordByEmail($address, $password);

		if (!$result) {
			return $this->fail([
				'message' => 'fail_to_generate_user_token'
			], 400);
		} else {
			$id = Users::findEmail($address)->user_id;
			return $this->success([
				'token' => JWT::encode('user', $id),
				'message' => 'success_to_generate_user_token'
			]);
		}
	}

	public function generateAdminTokenByUsername()
	{
		$password = $this->get('password', 'required');
		$username = $this->get('username', 'required');

		$where = ['username' => $username];
		$result = Admins::matchPassword($where, $password);

		if (!$result) {
			return $this->fail([
				'message' => 'fail_to_generate_admin_token'
			], 400);
		} else {
			$admin = Admins::findByUsername($username);
			return $this->success([
				'message' => 'success_to_generate_admin_token',
				'token' => JWT::encode('admin', $admin->id)
			]);
		}
	}

	public function rootToggle()
	{
		$auth = JWT::sub() === 'user' ? 'admin' : 'user';

		return success_response([
			'message' => 'success_to_toggle_root_auth',
			'token' => JWT::encode($auth, JWT::aud())
		]);
	}

	public function parseToken()
	{
		$token = JWT::isNeedToRefresh() ? JWT::refresh() : '';

		return [
			'token' => $token,
			'auth' => JWT::sub(),
			'roles' => Auth::account()->roles
		];
	}

	public function checkRootRole()
	{
		return $this->success('role_is_valid', 200);
	}
}
