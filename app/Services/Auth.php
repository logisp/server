<?php

namespace App\Services;

class Auth
{
  protected $system;

  protected $account;

  protected $tokenData;

  public function setAccount($account)
  {
    $this->account = $account;
  }

  public function setSystem($system)
  {
    $this->system = $system;
  }

  public function setTokenData($tokenData)
  {
    $this->tokenData = $tokenData;
  }

  public function user()
  {
    return $this->account;
  }

  public function admin()
  {
    return $this->account;
  }

  public function system()
  {
    return $this->system;
  }

  public function account()
  {
    return $this->account;
  }

  public function tokenData()
  {
    return $this->tokenData;
  }
}
