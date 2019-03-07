<?php

namespace Tests\Feature;

use Test;

class FeeTest extends TestCase
{
  public function testCreate()
  {
    $name = '___test_fee___';

    $response = $this->withRootAdmin()
      ->post('fees/create', [
        'name' => $name,
        'points' => 1000,
        'comment' => 'test_fee_comment'
      ]);

    $response->assertStatus(201);

    return $name;
  }

  /**
   * @depends testCreate
   */
  public function testUpdatePoints($name)
  {
    $response = $this->withRootAdmin()
      ->post('fees/points/update', [
        'name' => $name,
        'points' => 10000
      ]);
    $response->assertStatus(201);
  }

  /**
   * @depends testCreate
   */
  public function testUpdateComment($name)
  {
    $response = $this->withRootAdmin()
      ->post('fees/comment/update', [
        'name' => $name,
        'comment' => 'test_fee_comment_update'
      ]);

    $response->assertStatus(201);
  }

  /**
   * @depends testCreate
   */
  public function testDelete($name)
  {
    $response = $this->withRootAdmin()
      ->post('fees/delete', ['name' => $name]);
    $response->assertStatus(201);
  }
}
