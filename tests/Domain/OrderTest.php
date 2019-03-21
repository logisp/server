<?php

namespace Tests\Domain;

use App\Domain\Facades\Orders;

class OrderTest extends TestCase
{
  public function testCreate()
  {
    $id = 0;
    $insert = [
      'id' => $id,
      'outbound_method' => 'amazon'
    ];
    Orders::create(0, [$insert]);
    $this->assertTrue(true);

    return $id;
  }

  /**
   * @depends testCreate
   */
  public function testUpdate($id)
  {
    $update = ['outbound_method' => 'individual'];
    Orders::update([$id], $update);
    $this->assertTrue(true);
  }

  /**
   * @depends testCreate
   */
  public function testFindById($id)
  {
    $order = Orders::findById($id);
    $this->assertNotNull($order);
  }

  /**
   * @depends testCreate
   */
  public function testGetUserId($id)
  {
    $id = Orders::getUserId($id);
    $this->assertTrue($id === 0);
  }

  /**
   * @depends testCreate
   */
  public function testUserSearch()
  {
    $orders = Orders::userSearch(0);
    $this->assertNotNull($orders);
  }

  /**
   * @depends testCreate
   */
  public function testAdminSearch()
  {
    $orders = Orders::adminSearch();
    $this->assertNotNull($orders);
  }

  // /**
  //  * @depends testCreate
  //  */
  // public function testLog($id)
  // {
  //   Orders::log($id, 'test', 'test comment', 10);
  //   $logs = Orders::getLogsById($id);
  //   $this->assertNotNull($logs);
  // }

  // /**
  //  * @depends testCreate
  //  */
  // public function testDeleteLogsById($id)
  // {
  //   Orders::deleteLogsById($id);
  //   $logs = Orders::getLogsById($id);
  //   $this->assertNotNull($logs);
  // }

  /**
   * @depends testCreate
   */
  public function testDelete($id)
  {
    Orders::delete([$id]);
    $this->assertNull(Orders::findById($id));
  }
}
