<?php

namespace Tests\Domain;

use App\Domain\Facades\Admins;

class AdminTest extends TestCase
{
  protected $username = '__test_admins__username__';
  protected $password = '123456';

  public function testCreateByUsername()
  {
    $username = $this->username;
    $password = $this->password;

    $id = Admins::createByUsername($username, $password);
    $this->assertNotNull($id);

    return $id;
  }

  /**
   * @depends testCreateByUsername
   */
  public function testFindById($id)
  {
    $admin = Admins::findById($id);
    $this->assertNotNull($admin);
  }

  /**
   * @depends testCreateByUsername
   */
  public function testFindByUsername($id)
  {
    $admin = Admins::findByUsername($this->username);
    $this->assertNotNull($admin);
  }

  /**
   * @depends testCreateByUsername
   */
  public function testMatchPassword($id)
  {
    $result = Admins::matchPassword($id, $this->password);
    $this->assertTrue($result);
  }

  /**
   * @depends testCreateByUsername
   */
  public function testDeleteById($id)
  {
    Admins::deleteById($id);
    $this->assertNull(Admins::findById($id));
  }
}
