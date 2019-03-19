<?php

namespace App\Domain;

use DB;
use Hash;
use Carbon\Carbon;

class Users
{
  protected $visibleUserColumns = [
    'users.id', 'users.is_dropped',
    'users.created_at', 'users.dropped_at',
    'users.username', 'users.points', 'users.roles',
    'users.first_name', 'users.second_name',
  ];

  protected $invisibleUserColumns = [
    'users.password'
  ];

  public function findById($id, $columns = [])
  {
    $select = sizeof($columns) ? $columns : $this->visibleUserColumns;
    $user = DB::table('users')
      ->select($select)
      ->where('id', $id)
      ->first();
    if ($user) {
      $user->roles = json_decode($user->roles);
    }

    return $user;
  }

  public function findByEmail($email, $columns = [])
  {
    $select = sizeof($columns) ? $columns : $this->visibleUserColumns;
    $user = DB::table('users')
      ->leftJoin('user_emails', 'id', 'user_id')
      ->select($select)
      ->where('address', $email)
      ->first();
    if ($user) {
      $user->roles = json_decode($user->roles);
    }

    return $user;
  }

  public function search($page, $perPage, $where)
  {
    return DB::table('users')
      ->select($this->visibleUserColumns)
      ->where($where)
      ->andWhere('id', '>', 0)
      ->offset($perPage * ($page - 1))
      ->limit($perPage)
      ->get();
  }

  // 需要绑定 email 或 username
  public function createUser($password)
  {
    $insert = [
      'password' => Hash::make($password)
    ];
    $id = DB::table('users')->insertGetId($insert);

    return $id;
  }

  public function updateUser($ids, $update)
  {
    if (!is_array($ids)) {
      $ids = [$ids];
    }

    DB::table('users')->whereIn('id', [$ids])->update($update);
  }

  public function deleteById($id)
  {
    DB::table('users')->where('id', $id)->delete();
  }

  public function matchPassword($id, $password)
  {
    $where = ['id' => $id];
    $hashedPassword = DB::table('users')
      ->select('password')
      ->where($where)
      ->first()
      ->password;

    $result = Hash::check($password, $hashedPassword);

    return $result;
  }

  public function setUsername($id, $username)
  {
    $update = ['username' => $username];

    DB::table('users')->where('id', $id)->update($update);
  }

  public function findEmailById($userId)
  {
    $where = ['user_id' => $userId];

    return DB::table('user_emails')->where($where)->first();
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

  public function deleteEmailsById($userId)
  {
    $where = ['user_id' => $userId];

    DB::table('user_emails')->where($where)->delete();
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

  /**
   * helpers in testing
   */

  public function createRootUser($password = '123456')
  {
    $insert = [
      'id' => 0,
      'username' => 'root',
      'password' => Hash::make($password),
      'roles' => '["root"]'
    ];

    DB::table('users')->insert($insert);
  }

  public function createRootEmail($email)
  {
    $insert = [
      'user_id' => 0,
      'address' => $email
    ];

    DB::table('user_emails')->insert($insert);
  }

}
