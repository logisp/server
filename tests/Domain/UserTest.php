<?php

namespace Tests\Domain;

use App\Domain\Facades\Users;

class UserTest extends TestCase
{
  protected $password = '123456';
  protected $address = 'testuser@logisp.com';

  public function testCreate()
  {
    $userId = Users::createUser($this->password);
    $this->assertNotNull($userId);

    return $userId;
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
   * @depends testCreate
   */
  public function testMatchPassword($id)
  {
    $result = Users::matchPassword($id, $this->password);
    $this->assertTrue($result);
  }

  /**
   * @depends testCreate
   */
  public function testCreateEmail($id)
  {
    $result = Users::createEmail($id, $this->address);
    $this->assertNotNull($result);

    return $id;
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
   * @depends testCreateEmail
   */
  public function testFindEmailById($id)
  {
    $email = Users::findEmailById($id);
    $this->assertTrue($email->address === $this->address);
  }

  /**
   * @depends testCreateEmail
   */
  public function testDeleteEmails($id)
  {
    Users::deleteEmailsById($id);
    $userId = Users::findByEmail($this->address);
    $this->assertNull($userId);
  }

  // /**
  //  * @depends testCreate
  //  */
  // public function testEmail($userId)
  // {
  //   $address = 'testemail@logisp.com';

  //   Users::createEmail($userId, $address);
  //   $this->assertTrue(Users::getEmail($userId)->address == $address);

  //   Users::setEmailVerified($address);
  //   $this->assertTrue(Users::getEmail($userId)->is_verified);

  //   Users::deleteEmail($userId, $address);
  //   $this->assertNull(Users::getEmail($userId));
  // }

  // /**
  //  * @depends testCreate
  //  */
  // public function testCreditCardAccount($userId)
  // {
  //   $creditCardId = '123908147012983';
  //   $creditCardName = 'test name';

  //   Users::createCreditCardAccount($userId, $creditCardId, $creditCardName);
  //   $this->assertNotNull(Users::getCreditCardAccount($userId));

  //   Users::setCreditCardAccountVerified($userId, $creditCardId, true);
  //   $this->assertTrue(Users::getCreditCardAccount($userId)->is_verified);

  //   Users::setCreditCardAccountTerm($userId, $creditCardId, 10);

  //   Users::deleteCreditCardAccount($userId, $creditCardId);
  //   $this->assertNull(Users::getCreditCardAccount($userId, $creditCardId));
  // }

  // /**
  //  * @depends testCreate
  //  */
  // public function testAmazonAccount($userId)
  // {
  //   $amazonId = '123412345123';
  //   $amazonToken = '1qaz2wsx3edc';

  //   Users::createAmazonAccount($userId, $amazonId, $amazonToken);
  //   $this->assertNotNull(Users::getAmazonAccount($userId));

  //   Users::setAmazonAccountVerified($userId, $amazonId);
  //   $this->assertTrue(Users::getAmazonAccount($userId, $amazonId)->is_verified);

  //   Users::deleteAmazonAccount($userId, $amazonId);
  //   $this->assertNull(Users::getAmazonAccount($userId, $amazonId));
  // }

  // /**
  //  * @depends testCreate
  //  */
  // public function testSetUser($userId)
  // {
  //   $firstName = 'first name';
  //   $secondName = 'second name';
  //   $username = '__test_username_logisp__213__';

  //   Users::setUsername($userId, $username);
  //   $this->assertTrue(Users::findById($userId)->username === $username);

  //   Users::setFullName($userId, $firstName, $secondName);
  //   $this->assertTrue(true);
  // }

  /**
   * @depends testCreate
   */
  public function testDelete($id)
  {
    Users::deleteById($id);
    $user = Users::findById($id);
    $this->assertNull($user);
  }
}
