<?php

namespace App\Domain\Facades;

use Illuminate\Support\Facades\Facade;

class Orders extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'App\Domain\Orders';
  }
}
