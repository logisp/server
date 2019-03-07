<?php

namespace App\Services;

use DB;
use JWT;
use App\Domain\Facades\Users;
use App\Domain\Facades\Admins;

class Test
{
  private $user;

  private $admin;

  public function __construct()
  {
    $this->setUser();
    $this->setAdmin();
  }

  private function setUser()
  {
    $user = Users::findById(0);
    $data = ['sys' => 'user', 'id' => $user->id];
    $user->token = JWT::generate($data);
    $user->email = Users::getEmailByUserId(0);

    $this->user = $user;
  }

  private function setAdmin()
  {
    $admin = Admins::findById(0);
    $data = ['sys' => 'admin', 'id' => $admin->id];
    $admin->token = JWT::generate($data);

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
}
