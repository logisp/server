<?php

namespace Tests\Unit;

use JWT;

class JwtServiceTest extends TestCase
{
  protected $user = [
    'id' => 1,
    'name' => 'foo',
    'email' => 'bar',
    'roles' => [
      1, 3, 4, 2
    ]
  ];

  public function testEncode()
  {
    $token = JWT::encode($this->user);
    $this->assertNotNull($token);

    return $token;
  }

  /**
   * @depends testEncode
   */
  public function testDecode($token)
  {
    $tokenData = JWT::decode($token);

    $this->assertNotNull($tokenData);
  }

  /**
   * @depends testEncode
   */
  public function testRefresh($token)
  {
    $token = JWT::refresh();
    $this->assertNotNull($token);
  }
}
