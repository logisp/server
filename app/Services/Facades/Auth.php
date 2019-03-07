<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class Auth extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'App\Services\Auth';
  }
}
