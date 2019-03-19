<?php

namespace Tests\Domain;

use App\Domain\Facades\Carts;

class CartTest extends TestCase
{
  public function testCreate()
  {
    $id = Carts::add();
    $this->assertNotNull($id);
    
    return $id;
  }

  /**
   * @depends testCreate
   */
  public function testUpdate($id)
  {
    Carts::update($id, ['outbound_method' => 'test']);
    $this->assertTrue(true);
  }

  /**
   * @depends testCreate
   */
  public function testGetByIds($id)
  {
    $carts = Carts::getByIds([$id]);
    $this->assertNotNull($carts);
  }

  /**
   * @depends testCreate
   */
  public function testDelete($id)
  {
    Carts::delete([$id]);
    $this->assertTrue(true);
  }
}
