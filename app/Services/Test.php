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
    $data = [ 'aud' => 'user', 'id' => 0 ];
    $user->token = JWT::encode($data);
    $user->email = Users::findEmailById(0);

    $this->user = $user;
  }

  private function setAdmin()
  {
    $admin = Admins::findById(0);
    $data = [
      'aud' => 'admin',
      'id' => 0,
    ];
    $admin->token = JWT::encode($data);

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
