<?php

namespace Tests\Domain;

use App\Domain\Facades\CommodityOrders as Orders;

class CommodityOrderTest extends TestCase
{
  protected $userId = 10;

  public function testCreate()
  {
    $insert = [
      'user_id' => $this->userId,
      'outbound_method' => 'fba'
    ];
    $id = Orders::create($insert);
    $this->assertNotNull($id);

    return $id;
  }

  /**
   * @depends testCreate
   */
  public function testUpdate($id)
  {
    $update = ['outbound_method' => 'individual'];
    Orders::update($id, $update);
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
  public function testUserSearch()
  {
    $orders = Orders::userSearch($this->userId);
    $this->assertNotNull($orders);
  }

  public function testAdminSearch()
  {
    $orders = Orders::adminSearch();
    $this->assertNotNull($orders);
  }

  /**
   * @depends testCreate
   */
  public function testLog($id)
  {
    Orders::log($id, 'test', 'test comment', 10);
    $logs = Orders::getLogsById($id);
    $this->assertNotNull($logs);
  }

  /**
   * @depends testCreate
   */
  public function testDeleteLogsById($id)
  {
    Orders::deleteLogsById($id);
    $logs = Orders::getLogsById($id);
    $this->assertNotNull($logs);
  }

  /**
   * @depends testCreate
   */
  public function testDeleteById($id)
  {
    Orders::deleteById($id);
    $this->assertNull(Orders::findById($id));
  }
}
