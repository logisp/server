<?php

namespace App\Domain\Facades;

use Illuminate\Support\Facades\Facade;

class Admins extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'App\Domain\Admins';
  }
}
