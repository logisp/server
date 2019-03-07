<?php

namespace App\Http\Controllers;

use Transaction;
use App\Domain\Facades\Users;

class UserController extends Controller
{
	public function createByEmail()
	{
		$address = $this->get('address', 'required|email');
		$password = $this->get('password', 'required');

		Transaction::begin();
		$id = Users::createUser($password);
		Users::createEmail($id, $address);
		Transaction::commit();

		$message = 'success_to_create_user_by_email';

		return $this->success([
			'id' => $id,
			'message' => $message
		]);
	}

	public function delete()
	{
		$id = $this->get('id', 'required');

		Transaction::begin();
		Users::deleteById($id);
		Users::deleteEmailsByUserId($id);
		// Users::deleteAmazonAccounts($id);
		// Users::deleteCreditCardAccounts($id);
		Transaction::commit();

		$message = 'success_to_delete_user';

		return $this->success($message);
	}
}
