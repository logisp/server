<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class Cart extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'App\Services\Cart';
  }
}
