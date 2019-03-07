<?php

namespace Tests\Domain;

use App\Domain\Facades\Fees;

class FeeTest extends TestCase
{
  protected $name = 'test';

  public function testCreate()
  {
    $id = Fees::create($this->name, 1000, 'test_fee_item');
    $this->assertNotNull($id);
  }

  /**
   * @depends testCreate
   */
  public function testAll()
  {
    $fees = Fees::all();
    $this->assertNotNull($fees);
  }

  /**
   * @depends testCreate
   */
  public function testGetByName()
  {
    $fee = Fees::getByName($this->name);
    $this->assertNotNull($fee);
  }

  /**
   * @depents testCreate
   */
  public function testUpdatePoints()
  {
    $points = 998;
    Fees::updatePoints($this->name, $points);
    $fee = Fees::getByName($this->name);
    $this->assertTrue($fee->points === $points);
  }

  /**
   * @depends testCreate
   */
  public function testUpdateComment()
  {
    $comment = 'test_set_comment';
    Fees::updateComment($this->name, $comment);
    $fee = Fees::getByName($this->name);
    $this->assertTrue($fee->comment === $comment);
  }

  /**
   * @depends testCreate
   */
  public function testDeleteByName()
  {
    Fees::deleteByName($this->name);
    $fee = Fees::getByName($this->name);
    $this->assertNull($fee);
  }
}
