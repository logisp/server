<?php

namespace Tests\Feature;

class UserTest extends TestCase
{
  protected $address = 'unittest@logisp.com';
  protected $password = '123456';

  public function testRegisterByEmail()
  {
    $params = [
      'address' => $this->address,
      'password' => $this->password
    ];
    $response = $this->post('user/register/email', $params);
    $status = $response->status();
    if ($status === 422) {
      $this->assertTrue(true);
    } else {
      $response->assertStatus(201);
    }
  }

  public function testAdminSearch()
  {
    $params = ['page' => 1, 'perPage' => 10];
    $response = $this->withRootAdmin()->post('admin/users/search', $params);
    $response->assertStatus(200);
  }

  /**
   * @depends testRegisterByEmail
   */
  public function testDeleteUser($id)
  {
    $response = $this->withRootUser()
      ->post('user/delete/email', ['address' => $this->address]);
    $response->assertStatus(201);
  }

  public function testGetPersonal()
  {
    $response = $this->withRootUser()
      ->post('user/personal/get');
    $response->assertStatus(200);
  }

  public function testUpdatePersonal()
  {
    $response = $this->withRootUser()
      ->post('user/personal/update', ['name' => 'test']);
    $response->assertStatus(201);
  }
}
