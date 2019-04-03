<?php

namespace App\Domain\Facades;

use Illuminate\Support\Facades\Facade;

class Series extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'App\Domain\Series';
  }
}
