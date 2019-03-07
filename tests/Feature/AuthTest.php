<?php

namespace Tests\Feature;

use Test;

class AuthTest extends TestCase
{
  public function testGenerateUserTokenByEmail()
  {
    $user = Test::user();

    $response = $this->post('/user/auth/email', [
      'email' => $user->email->address,
      'password' => '123456',
    ]);
    // dd ($response->decodeResponseJson());
    $response->assertStatus(201);
  }

  public function testGenerateAdminTokenByUsername()
  {
    $admin = Test::admin();

    $response = $this->post('/admin/auth/username', [
      'username' => $admin->username,
      'password' => '123456'
    ]);

    $response->assertStatus(201);
  }

  public function testRefresh()
  {
    $response = $this->withRootUser()
      ->post('auth/refresh');

    $response->assertStatus(201);
  }

  public function testCheckToken()
  {
    $response = $this->withRootUser()
      ->post('auth/check');

    $response->assertStatus(200);
  }

  public function testCheckUserToken()
  {
    $response = $this->withRootUser()
      ->post('auth/user/check');

    $response->assertStatus(200);
  }

  public function testCheckAdminToken()
  {
    $response = $this->withRootUser()
      ->post('auth/user/check');

    $response->assertStatus(200);
  }

  public function testCheckUserTokenFail()
  {
    $response = $this->withRootAdmin()
      ->post('auth/user/check');

    $response->assertStatus(403);
  }

  public function testCheckAdminTokenFail()
  {
    $response = $this->withRootUser()
      ->post('auth/admin/check');

    $response->assertStatus(403);
  }

  public function testCheckRootRole()
  {
    $response = $this->withRootUser()
      ->post('auth/user/role/check');

    $response->assertStatus(200);
  }
}
