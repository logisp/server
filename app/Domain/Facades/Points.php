<?php

namespace App\Domain\Facades;

use Illuminate\Support\Facades\Facade;

class Points extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'App\Domain\Points';
  }
}
