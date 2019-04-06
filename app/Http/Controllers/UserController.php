<?php

namespace App\Http\Controllers;

use Auth;
use Transaction;
use App\Domain\Facades\Users;
use App\Domain\Facades\Series;

class UserController extends Controller
{
	public function createUserByEmail()
	{
		$password = $this->get('password', 'required');
		$address = $this->get('address', 'required|unique:user_emails,address');

		Transaction::begin();
		$id = Users::create(['password' => $password]);
		Users::createEmail($id, $address);
		Transaction::commit();

		return $this->success([
			'id' => $id,
			'message' => 'success_to_create_user_by_email'
		]);
	}

	public function getPersonal()
	{
		$where = ['id' => Auth::user()->id];
		$columns = ['name', 'mobile', 'zipcode', 'address'];

		$data = Users::find($where, $columns);

		return (array) $data;
	}

	public function updatePersonal()
	{
		$where = ['id' => Auth::user()->id];

		Users::update($where, [
			'name' => $this->get('name', 'nullable', ''),
			'mobile' => $this->get('mobile', 'nullable', ''),
			'zipcode' => $this->get('zipcode', 'nullable', ''),
			'address' => $this->get('address', 'nullable', '')
		]);

		return $this->success('success_to_update_user_personal');
	}

	public function deleteByEmail()
	{
		$address = $this->get('address', 'required');

		$user = Users::findByEmail($address);

		Transaction::begin();
		Users::delete($user->id);
		Users::deleteEmail(['user_id' => $user->id]);
		// Users::deleteAmazonAccounts($id);
		// Users::deleteCreditCardAccounts($id);
		Transaction::commit();

		return $this->success('success_to_delete_user');
	}

	public function adminSearch()
	{
		$page = $this->get('page', 'numeric');
		$perPage = $this->get('perPage', 'numeric');

		return Users::adminSearch($page, $perPage);
	}
}
