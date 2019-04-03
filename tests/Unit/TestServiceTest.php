<?php

namespace Tests\Unit;

use Test;

class TestServiceTest extends TestCase
{
  public function test()
  {
    $this->assertNotNull(Test::user());
    $this->assertNotNull(Test::admin());
    $this->assertNotNull(Test::password());
  }
}
