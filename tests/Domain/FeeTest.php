<?php

namespace Tests\Domain;

use App\Domain\Facades\Fees;

class FeeTest extends TestCase
{
  protected $name = 'test';

  public function testCreate()
  {
    Fees::create([
      'name' => $this->name,
      'points' => 1000,
      'comment' => 'test_fee_item'
    ]);
    $this->assertTrue(true);
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
   * @depents testCreate
   */
  public function testUpdatePoints()
  {
    $points = 998;
    Fees::updatePoints($this->name, $points);
    $this->assertTrue(true);
  }

  /**
   * @depends testCreate
   */
  public function testUpdateComment()
  {
    $comment = 'test_set_comment';
    Fees::updateComment($this->name, $comment);
    $this->assertTrue(true);
  }

  /**
   * @depends testCreate
   */
  public function testDelete()
  {
    Fees::delete($this->name);
    $this->assertTrue(true);
  }

  public function testLog()
  {
    Fees::log([
      'name' => 'test',
      'admin_id' => 0,
      'points' => 1000,
      'comment' => 'test_comment'
    ]);
    $this->assertTrue(true);
  }

  public function testGetFeeLogs()
  {
    $fees = Fees::getFeeLogs();
    $this->assertTrue(true);
  }

  /**
   * @depends testLog
   */
  public function testDeleteFeeLogs()
  {
    return Fees::deleteFeeLogs('test');
  }
}
