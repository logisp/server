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

  public function testEncodeDecode()
  {
    $token = JWT::encode($this->user);
    $this->assertNotNull(JWT::decode($token));
  }

  public function testGenerate()
  {
    $tokenInfo = JWT::generate($this->user);

    $this->assertNotNull($tokenInfo);

    return $tokenInfo->token;
  }

  /**
   * @depends testGenerate
   */
  public function testRefreshParse($token)
  {
    JWT::parse($token);
    $token = JWT::refresh();
    JWT::parse($token->token);

    $this->assertFalse(JWT::isNeedToRefresh());
    $this->assertEquals((object) $this->user, JWT::tokenData());
  }
}
