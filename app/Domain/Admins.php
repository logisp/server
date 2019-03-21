<?php

namespace App\Domain;

use DB;
use Hash;

class Admins
{
  protected $visibleColumns = [
    'id', 'email', 'username', 'roles',
    'first_name', 'second_name'
  ];

  public function findById($id)
  {
    $admin = DB::table('user_admins')
      ->select($this->visibleColumns)
      ->where('id', $id)
      ->first();

    if ($admin) {
      $admin->roles = json_decode($admin->roles);
    }

    return $admin;
  }

  public function findByUsername($username)
  {
    $admin = DB::table('user_admins')
      ->select($this->visibleColumns)
      ->where('username', $username)
      ->first();

    if ($admin) {
      $admin->roles = json_decode($admin->roles);
    }

    return $admin;
  }

  public function search($page, $perPage, $where)
  {
    return DB::table('user_admins')
      ->select($this->visibleColumns)
      ->where($where)
      ->offset($perPage * ($page - 1))
      ->limit($perPage)
      ->get();
  }

  public function createByUsername($username, $password)
  {
    $insert = [
      'username' => $username,
      'password' => Hash::make($password)
    ];
    $id = DB::table('user_admins')->insertGetId($insert);

    return $id;
  }

  public function createRootAdmin($username, $password)
  {
    $insert = [
      'id' => 0,
      'username' => $username,
      'password' => Hash::make($password),
      'roles' => '["root"]'
    ];

    DB::table('user_admins')->insert($insert);
  }

  // public function createTestAdmin($username, $password)
  // {
  //   $minId = DB::table('users_admins')
  //     ->select(DB::raw('min(id)'))
  //     ->first()
  //     ->min;

  //   $insert = [
  //     'id' => $minId--,
  //     'password' => Hash::make($password)
  //   ];

  //   DB::table('user_admins')->insert($insert);
  // }

  public function deleteById($id)
  {
    $where = ['id' => $id];
    DB::table('user_admins')->where($where)->delete();
  }

  public function matchPassword($id, $password)
  {
    $where = ['id' => $id];
    $hashedPassword = DB::table('user_admins')
      ->select('password')
      ->where($where)
      ->first()
      ->password;

    $result = Hash::check($password, $hashedPassword);

    return $result;
  }
}
