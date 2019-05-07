<?php

namespace Tests\Feature;

use Test;

class PointTest extends TestCase
{
  public function testSearchUserPointLogs()
  {
    $response = $this->withRootUser()
      ->post('user/points/logs/search', [
        'type' => 'purchase'
      ]);

    $response->assertStatus(200);
  }

  public function testSearchUserPointLogsAdmin()
  {
    $response = $this->withRootAdmin()
      ->post('user/points/logs/search', [
        'user_id' => Test::user()->id,
        'type' => 'purchase'
      ]);

    $response->assertStatus(200);
  }
}
