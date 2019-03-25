<?php

namespace Tests\Feature;

use Test;

class FeeTest extends TestCase
{
  public function testAll()
  {
    $response = $this->withRootAdmin()
      ->post('fees/all');
    $response->assertStatus(200);
  }

  public function testUpdatePoints()
  {
    $comment = 'test_update';
    $response = $this->withRootAdmin()
      ->post('fees/points/update', [
        'name' => 'fba_outbound_standard_new',
        'points' => 100,
        'comment' => $comment,
      ]);
    $response->assertStatus(201);
  }

  public function testSearchLogs()
  {
    $response = $this->withRootAdmin()
      ->post('fees/logs/search', [
        'page' => 1,
        'name' => 'fba_outbound_standard_new'
      ]);

    $response->assertStatus(200);
  }
}
