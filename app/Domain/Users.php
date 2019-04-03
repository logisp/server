<?php

namespace App\Domain;

use DB;
use Hash;
use Carbon\Carbon;

class Users
{
  // 需要绑定 email 或 username
  public function create($data)
  {
    if (!isset($data['id'])) {
      $data['id'] = $this->generateId();
    }
    if (isset($data['roles'])) {
      $data['roles'] = json_encode($data['roles']);
    }
    $data['password'] = Hash::make($data['password']);
    DB::table('users')->insert($data);

    return $data['id'];
  }

  public function createEmail($userId, $address)
  {
    $insert = [
      'user_id' => $userId,
      'address' => $address
    ];

    DB::table('user_emails')->insert($insert);

    return true;
  }

  // 无需测试
  public function find($where, $columns = [])
  {
    $select = sizeof($columns) ? $columns : '*';
    $user = DB::table('users')
      ->select($select)
      ->where($where)
      ->first();

    if ($user && isset($user->roles)) {
      $user->roles = json_decode($user->roles);
    }

    return $user;
  }

  public function findById($id, $columns = [])
  {
    return $this->find(['id' => $id], $columns);
  }

  public function findByUsername($username, $columns = [])
  {
    return $this->find(['username' => $username], $columns);
  }

  public function findEmail($address)
  {
    return DB::table('user_emails')
      ->where('address', $address)
      ->first();
  }

  public function findByEmail($address, $columns = [])
  {
    $email = DB::table('user_emails')
      ->where('address', $address)
      ->select(['user_id'])
      ->first();
    if ($email) {
      return $this->find(['id' => $email->user_id], $columns);
    } else {
      return null;
    }
  }

  public function search($page = 1, $perPage = 10, $where = [])
  {
    return DB::table('users')
      ->select($this->visibleUserColumns)
      ->where($where)
      ->andWhere('id', '>', 0)
      ->offset($perPage * ($page - 1))
      ->limit($perPage)
      ->get();
  }

  public function update($where, $update)
  {
    DB::table('users')->where($where)->update($update);
  }

  public function matchPassword($where, $password)
  {
    $user = DB::table('users')
      ->select('password')
      ->where($where)
      ->first();
    if ($user) {
      return Hash::check($password, $user->password);
    } else {
      return false;
    }
  }

  public function matchPasswordByEmail($address, $password)
  {
    // $user = DB::table('users')
    //   ->select('password')
    //   ->leftJoin('user_emails', 'id', 'user_id')
    //   ->where('address', $address)
    //   ->first();
    $user = $this->findByEmail($address, ['password']);
    if ($user) {
      return Hash::check($password, $user->password);
    } else {
      return false;
    }
  }

  public function deleteEmail($where)
  {
    DB::table('user_emails')->where($where)->delete();
  }

  public function delete($id)
  {
    DB::table('users')->where('id', $id)->delete();
  }

  // public function findEmailById($userId)
  // {
  //   $where = ['user_id' => $userId];

  //   return DB::table('user_emails')->where($where)->first();
  // }

  public function addCartsId($userId, $cartId)
  {
    DB::table('users')->where('id', $userId)->update([
      'cart_ids' => DB::raw('cart_ids || $cartId')
    ]);
  }

  public function getCartIds($userId)
  {
    $ids = DB::table('users')
      ->where('id', $userId)
      ->select(['cart_ids'])
      ->first()
      ->cart_ids;

    return json_decode($ids);
  }

  public function updateCartIds($userId, $ids)
  {
    DB::table('users')
      ->where('id', $userId)
      ->update(['cart_ids' => json_encode($ids)]);
  }

  // public function setEmailVerified($address, $isVerified = true)
  // {
  //   $where = ['address' => $address];
  //   $update = ['is_verified' => $isVerified];

  //   DB::table('user_emails')->where($where)->update($update);
  // }

  // public function deleteEmail($userId, $address)
  // {
  //   $where = [
  //     'user_id' => $userId,
  //     'address' => $address
  //   ];

  //   DB::table('user_emails')->where($where)->delete();
  // }

  public function createRootUser($id, $username, $password)
  {
    return $this->create([
      'id' => $id,
      'roles' => ['root'],
      'username' => 'root',
      'password' => $password,
    ]);
  }

  protected function generateId()
  {
    return Facades\Series::generate('user_id');
  }

  // public function getAmazonAccount($userId)
  // {
  //   $where = ['user_id' => $userId];

  //   return DB::table('user_amazon_accounts')->where($where)->first();
  // }

  // // 多个用户绑定同一个 amazon account
  // public function createAmazonAccount($userId, $amazonId, $amazonToken)
  // {
  //   $insert = [
  //     'id' => $amazonId,
  //     'user_id' => $userId,
  //     'token' => $amazonToken
  //   ];

  //   DB::table('user_amazon_accounts')->insert($insert);
  // }

  // public function setAmazonAccountVerified($userId, $amazonId, $isVerified = true)
  // {
  //   $where = [
  //     'id' => $amazonId,
  //     'user_id' => $userId
  //   ];
  //   $update = ['is_verified' => $isVerified];

  //   DB::table('user_amazon_accounts')->where($where)->update($update);
  // }

  // public function deleteAmazonAccount($userId, $amazonId)
  // {
  //   $where = [
  //     'id' => $amazonId,
  //     'user_id' => $userId
  //   ];

  //   DB::table('user_amazon_accounts')->where($where)->delete();
  // }

  // public function deleteAmazonAccounts($userId)
  // {
  //   $where = ['user_id' => $userId];

  //   DB::table('user_amazon_accounts')->where($where)->delete();
  // }

  // public function getCreditCardAccount($userId)
  // {
  //   return DB::table('user_credit_card_accounts')->where('user_id', $userId)->first();
  // }

  // public function createCreditCardAccount($userId, $creditCardId, $creditCardName)
  // {
  //   $insert = [
  //     'user_id' => $userId,
  //     'id' => $creditCardId,
  //     'name' => $creditCardName
  //   ];

  //   DB::table('user_credit_card_accounts')->insert($insert);
  // }

  // // 多个用户绑定同一张 credit card
  // public function setCreditCardAccountVerified($userId, $creditCardId, $isVerified = true)
  // {
  //   $where = [
  //     'user_id' => $userId,
  //     'id' => $creditCardId
  //   ];
  //   $update = ['is_verified' => $isVerified];

  //   DB::table('user_credit_card_accounts')->where($where)->update($update);
  // }

  // public function setCreditCardAccountTerm($userId, $creditCardId, $months)
  // {
  //   $where = [
  //     'user_id' => $userId,
  //     'id' => $creditCardId
  //   ];

  //   $now = Carbon::now();

  //   $update = [
  //     'effective_at' => Carbon::now(),
  //     'expired_at' => Carbon::now()->addMonth($months)
  //   ];

  //   DB::table('user_credit_card_accounts')->where($where)->update($update);
  // }

  // public function deleteCreditCardAccount($userId, $creditCardId)
  // {
  //   $where = [
  //     'user_id' => $userId,
  //     'id' => $creditCardId
  //   ];

  //   DB::table('user_credit_card_accounts')->where($where)->delete();
  // }

  // public function deleteCreditCardAccounts($userId)
  // {
  //   $where = ['user_id' => $userId];

  //   DB::table('user_credit_card_accounts')->where($where)->delete();
  // }

  // public function setFullName($id, $firstName, $secondName)
  // {
  //   $update = [
  //     'first_name' => $firstName,
  //     'second_name' => $secondName
  //   ];

  //   DB::table('users')->where('id', $id)->update($update);
  // }

  // public function createTestUser($password = '123456')
  // {
  //   $minId = DB::table('users')
  //     ->select(DB::raw('min(id)'))
  //     ->first()
  //     ->min;

  //   $insert = [
  //     'id' => $minId--,
  //     'username' => 'root_user_logisp_system998',
  //     'password' => Hash::make($password),
  //     'roles' => '["tester"]'
  //   ];

  //   DB::table('users')->insert($insert);

  //   return $id;
  // }
}
