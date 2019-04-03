<?php

namespace Tests\Domain;

use App\Domain\Facades\Admins;

class AdminTest extends TestCase
{
  protected $username = '@test';
  protected $password = '123456';

  public function testCreate()
  {
    $admin = Admins::findByUsername($this->username);
    if ($admin) {
      $this->assertTrue(true);
      return $admin->id;
    } else {
      $id = Admins::create([
        'roles' => [],
        'username' => $this->username,
        'password' => $this->password
      ]);
      $this->assertTrue(true);

      return $id;
    }
  }

  /**
   * @depends testCreate
   */
  public function testFindById($id)
  {
    $admin = Admins::findById($id);
    $this->assertNotNull($admin);
  }

  /**
   * @depends testCreate
   */
  public function testFindByUsername($id)
  {
    $admin = Admins::findByUsername($this->username);
    $this->assertNotNull($admin);
  }

  /**
   * @depends testCreate
   */
  public function testSearch($id)
  {
    $admins = Admins::search();
    $this->assertNotNull($admins);
  }

  /**
   * @depends testCreate
   */
  public function testMatchPasswordById($id)
  {
    $result = Admins::matchPassword(['id' => $id], $this->password);
    $this->assertTrue($result);
  }

  /**
   * @depends testCreate
   */
  public function testMatchPasswordByUsername($id)
  {
    $where = ['username' => $this->username];
    $result = Admins::matchPassword($where, $this->password);
    $this->assertTrue($result);
  }

  /**
   * @depends testCreate
   */
  public function testDelete($id)
  {
    Admins::delete($id);
    $this->assertNull(Admins::findById($id));
  }
}
