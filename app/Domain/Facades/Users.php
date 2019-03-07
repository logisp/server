<?php

namespace App\Domain\Facades;

use Illuminate\Support\Facades\Facade;

class Users extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'App\Domain\Users';
  }
}
