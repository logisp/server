<?php

namespace Tests\Domain;

use App\Domain\Facades\Users;

class UserTest extends TestCase
{
  protected $username = '$testuser';
  protected $password = '123456';
  protected $address = 'testuser@logisp.com';

  public function testCreate()
  {
    $user = Users::findByUsername($this->username);
    if ($user) {
      $this->assertTrue(true);

      return $user->id;
    } else {
      $userId = Users::create([
        'username' => $this->username,
        'password' => $this->password
      ]);
      $this->assertNotNull($userId);

      return $userId;
    }
  }

  /**
   * @depends testCreate
   */
  public function testAdminSearch()
  {
    $users = Users::adminSearch();
    $this->assertNotNull($users);
  }

  /**
   * @depends testCreate
   */
  public function testCreateEmail($id)
  {
    $email = Users::findEmail(['address' => $this->address]);
    if ($email) {
      $this->assertTrue(true);

      return $id;
    } else {
      $result = Users::createEmail($id, $this->address);
      $this->assertNotNull($result);
  
      return $id;
    }
  }

  /**
   * @depends testCreate
   */
  public function testFindById($id)
  {
    $user = Users::findById($id);
    $this->assertNotNull($user);
  }

  /**
   * @depends testCreateEmail
   */
  public function testFindByEmail($id)
  {
    $user = Users::findByEmail($this->address);
    $this->assertNotNull($user);
  }

  /**
   * @depends testCreate
   */
  public function testMatchPassword($id)
  {
    $result = Users::matchPassword(['id' => $id], $this->password);
    $this->assertTrue($result);
  }

  /**
   * @depends testCreateEmail
   */
  public function testDeleteEmail($id)
  {
    Users::deleteEmail(['address' => $this->address]);
    $email = Users::findEmail(['address' => $this->address]);
    $this->assertNull($email);
  }

  /**
   * @depends testCreate
   */
  public function testUpdateCartIds($id)
  {
    Users::updateCartIds($id, [1, 2, 3, 4]);
    $this->assertTrue(true);
  }

  /**
   * @depends testCreate
   */
  public function testGetCartIds($id)
  {
    $ids = Users::getCartIds($id);
    $this->assertEquals($ids, [1, 2, 3, 4]);
  }

  /**
   * @depends testCreate
   */
  public function testDelete($id)
  {
    Users::delete($id);
    $user = Users::findById($id);
    $this->assertNull($user);
  }
}
