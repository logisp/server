<?php

namespace Tests\Feature;

use Test;

class CartTest extends TestCase
{
  public function testAdd()
  {
    $response = $this->withRootUser()
      ->post('cart/add', ['data' => []]);
    $response->assertStatus(201);

    return $response->decodeResponseJson()['data']['id'];
  }

  /**
   * @depends testAdd
   */
  public function testUpdate($id)
  {
    $response = $this->withRootUser()
      ->post('cart/update', [
        'id' => $id,
        'data' => ['outbound_method' => 'test']
      ]);
    $response->assertStatus(201);
  }

  public function testGet()
  {
    $response = $this->withRootUser()
      ->post('cart/get');
    $response->assertStatus(200);
  }

  /**
   * @depends testAdd
   */
  public function testDelete($id)
  {
    $response = $this->withRootUser()
      ->post('cart/delete', ['cart_ids' => [$id]]);
    $response->assertStatus(201);
  }
}
