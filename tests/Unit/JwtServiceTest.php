<?php

namespace Tests\Unit;

use JWT;

class JwtServiceTest extends TestCase
{
  protected $aud = 10086;
  protected $sub = 2009;

  public function testEncode()
  {
    $token = JWT::encode('test', 1);
    $this->assertNotNull($token);

    return $token;
  }

  /**
   * @depends testEncode
   */
  public function testParse($token)
  {
    JWT::decode($token);
    $payload = JWT::payload();
    $sub = JWT::sub();
    $aud = JWT::aud();
    $this->assertTrue(true);
  }
}
