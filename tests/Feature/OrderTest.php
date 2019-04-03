<?php

namespace Tests\Feature;

use Test;

class OrderTest extends TestCase
{
  public function testCartAdd()
  {
    $response = $this->withRootUser()
      ->post('cart/add', ['data' => []]);
    $response->assertStatus(201);

    return [$response->decodeResponseJson()['data']['id']];
  }

  /**
   * @depends testCartAdd
   */
  public function testCreateFromCart($ids)
  {
    $response = $this->withRootUser()
      ->post('cart/order', ['cart_ids' => $ids]);
    $response->assertStatus(201);
  }

  /**
   * @depends testCreateFromCart
   */
  public function testUserSearch()
  {
    $response = $this->withRootUser()
      ->post('order/user/search');
    $response->assertStatus(200);

    return [$response->decodeResponseJson()[0]['id']];
  }

  /**
   * @depends testUserSearch
   */
  public function testPost($ids)
  {
    $response = $this->withRootUser()
      ->post('order/post', [
        'order_ids' => $ids,
        'logistic_id' => '123412341234',
        'logistic_inc' => 'asd'
      ]);
    $response->assertStatus(201);
  }

  /**
   * @depends testUserSearch
   */
  public function testConfirming($ids)
  {
    $response = $this->withRootUser()
      ->post('order/confirming', [
        'order_ids' => $ids,
      ]);
    $response->assertStatus(201);
  }

  /**
   * @depends testUserSearch
   */
  public function testAbandon($ids)
  {
    $response = $this->withRootUser()
      ->post('order/abandon', [
        'order_ids' => $ids,
      ]);
    $response->assertStatus(201);
  }

  /**
   * @depends testUserSearch
   */
  public function testInbound($ids)
  {
    $response = $this->withRootAdmin()
      ->post('order/inbound', [
        'order_ids' => $ids,
      ]);
    $response->assertStatus(201);
  }

  /**
   * @depends testUserSearch
   */
  public function testConfirm($ids)
  {
    $response = $this->withRootAdmin()
      ->post('order/confirm', [
        'order_ids' => $ids,
        'confirmed' => true
      ]);
    $response->assertStatus(201);
  }

  /**
   * @depends testUserSearch
   */
  public function testAbandoned($ids)
  {
    $response = $this->withRootAdmin()
      ->post('order/abandoned', [
        'order_ids' => $ids,
      ]);

    $response->assertStatus(201);
  }

  /**
   * @depends testUserSearch
   */
  public function testDelete($ids)
  {
    $response = $this->withRootUser()
      ->post('order/delete', ['order_ids' => $ids]);
    $response->assertStatus(201);
  }
}
