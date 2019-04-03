<?php

namespace Tests\Domain;

use App\Domain\Facades\Orders;

class OrderTest extends TestCase
{
  protected $userId = 0;

  public function testCreate()
  {
    $insert = ['outbound_method' => 'amazon'];
    Orders::create($this->userId, [$insert]);
    $this->assertTrue(true);
  }

  public function testUserSearch()
  {
    $orders = Orders::userSearch($this->userId);
    $this->assertNotNull($orders);
    return $orders[0]->id;
  }

  /**
   * @depends testUserSearch
   */
  public function testUpdate($id)
  {
    $update = ['outbound_method' => 'individual'];
    Orders::update([$id], $update);
    $this->assertTrue(true);
  }

  /**
   * @depends testUserSearch
   */
  public function testFindById($id)
  {
    $order = Orders::findById($id);
    $this->assertNotNull($order);
  }

  /**
   * @depends testUserSearch
   */
  public function testGetUserId($id)
  {
    $id = Orders::getUserId($id);
    $this->assertTrue($id === 0);
  }

  /**
   * @depends testUserSearch
   */
  public function testAdminSearch()
  {
    $orders = Orders::adminSearch();
    $this->assertNotNull($orders);
  }

  // /**
  //  * @depends testUserSearch
  //  */
  // public function testLog($id)
  // {
  //   Orders::log($id, 'test', 'test comment', 10);
  //   $logs = Orders::getLogsById($id);
  //   $this->assertNotNull($logs);
  // }

  // /**
  //  * @depends testUserSearch
  //  */
  // public function testDeleteLogsById($id)
  // {
  //   Orders::deleteLogsById($id);
  //   $logs = Orders::getLogsById($id);
  //   $this->assertNotNull($logs);
  // }

  /**
   * @depends testUserSearch
   */
  public function testDelete($id)
  {
    Orders::delete([$id]);
    $this->assertNull(Orders::findById($id));
  }
}
