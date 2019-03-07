<?php

namespace App\Http\Controllers;

use DB;
use JWT;
use App\Domain\Facades\Users;
use App\Domain\Facades\Admins;

class AuthController extends Controller
{
	public function generateUserTokenByEmail()
	{
		$email = $this->get('email', 'required');
		$password = $this->get('password', 'required');

		$id = Users::getUserIdByEmail($email);
		$result = Users::matchPassword($id, $password);

		if ($result) {
			$data = [
				'sys' => 'admin',
				'id' => $id
			];

			return $this->success([
				'message' => 'success_to_generate_user_token',
				'token' => JWT::generate($data)
			]);
		} else {
			return $this->fail([
				'message' => 'fail_to_generate_user_token'
			], 400);
		}
	}

	public function generateAdminTokenByUsername()
	{
		$username = $this->get('username', 'required');
		$password = $this->get('password', 'required');

		$id = Admins::findByUsername($username)->id;
		$result = Admins::matchPassword($id, $password);

		if ($result) {
			$data = [
				'sys' => 'admin',
				'id' => $id
			];

			return $this->success([
				'message' => 'success_to_generate_admin_token',
				'token' => JWT::generate($data)
			]);
		} else {
			return $this->fail([
				'message' => 'fail_to_generate_admin_token'
			], 400);
		}
	}

	public function checkToken()
	{
		if (JWT::isNeedToRefresh()) {
			$token = JWT::refresh();

			return $this->success([
				'message' => 'token_is_refreshed',
				'token' => $token
			]);
		} else {
			return $this->success('token_is_valid', 200);
		}
	}

	public function checkRootRole()
	{
		return $this->success('role_is_valid', 200);
	}

	public function refresh()
	{
		return success_response([
			'message' => 'success_to_refresh_token',
			'token' => JWT::refresh()
		], 201);
	}
}
