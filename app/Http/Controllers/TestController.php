<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
  public function root()
  {
    return 'Logisp Api Service';
  }

  public function testDebug()
  {
    return $this->success('success_to_visit_debug_api', 200);
  }
}
