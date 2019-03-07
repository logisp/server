<?php

namespace App\Services;

class Auth
{
  protected $system;

  protected $account;

  public function setAccount($account)
  {
    $this->account = $account;
  }

  public function setSystem($system)
  {
    $this->system = $system;
  }

  public function user()
  {
    if ($this->system === 'user') {
      return $this->account;
    }
  }

  public function admin()
  {
    if ($this->system === 'admin') {
      return $this->account;
    }
  }
}
