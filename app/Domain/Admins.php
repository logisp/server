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

  public function create($data)
  {
    if (isset($data['roles'])) {
      $data['roles'] = json_encode($data['roles']);
    }
    if (!isset($data['id'])) {
      $data['id'] = $this->generateId();
    }

    $data['password'] = Hash::make($data['password']);
    DB::table('user_admins')->insert($data);

    return $data['id'];
  }

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

  public function search($page = 1, $perPage = 10, $where = [])
  {
    return DB::table('user_admins')
      ->select($this->visibleColumns)
      ->where($where)
      ->offset($perPage * ($page - 1))
      ->limit($perPage)
      ->get();
  }

  public function matchPassword($where, $password)
  {
    $admin = DB::table('user_admins')
      ->select('password')
      ->where($where)
      ->first();
    if ($admin) {
      return Hash::check($password, $admin->password);
    } else {
      return false;
    }
  }

  public function delete($id)
  {
    DB::table('user_admins')->where('id', $id)->delete();
  }

  public function createRootAdmin($username, $password)
  {
    return $this->create([
      'roles' => ['root'],
      'username' => $username,
      'password' => $password
    ]);
  }

  /**
   * 
   */
  private function generateId()
  {
    return Facades\Series::generate('admin_id');
  }
}
