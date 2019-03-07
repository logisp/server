<?php

namespace Tests\Feature;

class TestTest extends TestCase
{
  public function testTest()
  {
    $response = $this->get('test/debug');

    $response->assertStatus(200);
  }
}
