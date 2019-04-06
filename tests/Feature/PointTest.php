<?php

namespace Tests\Feature;

use App\Domain\Facades\Points;

class PointTest extends TestCase
{
  public function test()
  {
    $this->assertTrue(true);
  }

  // public function testUserCreateOrder()
  // {
  //   $response = $this->withRootUser()
  //     ->post('points/order/create', [
  //       'points' => 1000
  //     ]);
  //   $response->assertStatus(201);

  //   return $response->decodeResponseJson()['id'];
  // }

  // /**
  //  * @depends testUserCreateOrder
  //  */
  // public function testAdminConfirm($id)
  // {
  //   $response = $this->withRootAdmin()
  //     ->post('points/order/confirm', ['id' => $id]);
  //   $response->assertStatus(201);
  // }

  // /**
  //  * @depends testUserCreateOrder
  //  */
  // public function testDeleteOrder($id)
  // {
  //   $response = $this->withRootAdmin()
  //     ->post('points/order/delete', ['id' => $id]);
  //   $response->assertStatus(201);
  // }

  // public function testAdminAdjust()
  // {
  //   $response = $this->withRootAdmin()
  //     ->post('points/adjust', [
  //       'user_id' => 0,
  //       'points' => 1000000
  //     ]);
  //   $response->assertStatus(201);

  //   return $response->decodeResponseJson()['id'];
  // }

  // /**
  //  * @depends testAdminAdjust
  //  */
  // public function testDeleteAdminAdjust($id)
  // {
  //   $response = $this->withRootAdmin()
  //     ->post('points/order/delete', ['id' => $id]);
  //   $response->assertStatus(201);
  // }

  // public function testUserRecharge()
  // {
  //   $response = $this->withRootUser()
  //     ->post('points/recharge', ['points' => 100000]);
  //   $response->assertStatus(201);

  //   return $response->decodeResponseJson()['id'];
  // }

  // /**
  //  * @depends testUserRecharge
  //  */
  // public function testDeleteUserRecharge($id)
  // {
  //   $response = $this->withRootAdmin()
  //     ->post('points/order/delete', ['id' => $id]);
  //   $response->assertStatus(201);
  // }

  // public function testUserSearch()
  // {
  //   $response = $this->withRootUser()
  //     ->post('points/orders/user/search');
  //   // dd($response->decodeResponseJson());
  //   $response->assertStatus(200);
  // }

  // public function testAdminSearch()
  // {
  //   $response = $this->withRootAdmin()
  //     ->post('points/orders/admin/search');
  //   // dd($response->decodeResponseJson());
  //   $response->assertStatus(200);
  // }
}
