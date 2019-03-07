<?php

namespace Tests\Feature;

class UserTest extends TestCase
{
  public function testRegisterByEmail()
  {
    $params = [
      'address' => 'test@gmail.com',
      'password' => '12341234'
    ];
    $response = $this->post('user/register/email', $params);
    $id = $response->decodeResponseJson()['id'];
    $response->assertStatus(201);

    return $id;
  }

  /**
   * @depends testRegisterByEmail
   */
  public function testDeleteUser($id)
  {
    $response = $this->withRootUser()
      ->post('user/delete', ['id' => $id]);
    $response->assertStatus(201);
  }
}
