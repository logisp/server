<?php

namespace App\Domain\Facades;

use Illuminate\Support\Facades\Facade;

class CommodityOrders extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'App\Domain\CommodityOrders';
  }
}
