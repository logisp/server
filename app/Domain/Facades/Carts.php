<?php

namespace App\Domain\Facades;

use Illuminate\Support\Facades\Facade;

class Carts extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'App\Domain\Carts';
  }
}
