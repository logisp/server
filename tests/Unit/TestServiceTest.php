<?php

namespace Tests\Unit;

use Test;

class TestServiceTest extends TestCase
{
  public function testUser()
  {
    $this->assertNotNull(Test::user());
  }

  public function testAdmin()
  {
    $this->assertNotNull(Test::admin());
  }
}
