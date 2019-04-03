<?php

namespace App\Services;

use DB;
use JWT;
use App\Domain\Facades\Users;
use App\Domain\Facades\Admins;

class Test
{
  protected $user;
  protected $admin;
  protected $email;
  protected $username;
  protected $password;

  public function __construct()
  {
    $this->password = env('ROOT_PASSWORD');
    $this->username = env('ROOT_USERNAME');
    $this->email = $this->username . '@logisp.com';
    $this->setUser();
    $this->setAdmin();
  }

  private function setUser()
  {
    $user = Users::findByUsername($this->username);
    $user->token = JWT::encode('user', $user->id);
    $user->email = Users::findEmail($this->email);
    $this->user = $user;
  }

  private function setAdmin()
  {
    $admin = Admins::findByUsername($this->username);
    $admin->token = JWT::encode('admin', $admin->id);
    $this->admin = $admin;
  }

  public function user()
  {
    return $this->user;
  }

  public function admin()
  {
    return $this->admin;
  }

  public function username()
  {
    return $this->username;
  }

  public function password()
  {
    return $this->password;
  }
}
