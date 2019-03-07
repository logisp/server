<?php

namespace App\Domain\Facades;

use Illuminate\Support\Facades\Facade;

class Fees extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'App\Domain\Fees';
  }
}
