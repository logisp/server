<?php

namespace Tests\Feature;

use Test;

class AuthTest extends TestCase
{
  public function testGenerateUserTokenByEmail()
  {
    $user = Test::user();

    $response = $this->post('/auth/user/email', [
      'address' => $user->email->address,
      'password' => Test::password(),
    ]);
    $response->assertStatus(201);
  }

  public function testGenerateAdminTokenByUsername()
  {
    $admin = Test::admin();

    $response = $this->post('/auth/admin/username', [
      'username' => $admin->username,
      'password' => Test::password()
    ]);

    $response->assertStatus(201);
  }

  public function testCheckToken()
  {
    $response = $this->withRootUser()
      ->post('auth/token/check');

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

  // public function testCheckUserTokenFail()
  // {
  //   $response = $this->withRootAdmin()
  //     ->post('auth/user/check');

  //   $response->assertStatus(403);
  // }

  // public function testCheckAdminTokenFail()
  // {
  //   $response = $this->withRootUser()
  //     ->post('auth/admin/check');

  //   $response->assertStatus(403);
  // }

  public function testCheckRootRole()
  {
    $response = $this->withRootUser()
      ->post('auth/user/role/root/check');

    $response->assertStatus(200);
  }

  // public function testCheckFailRole()
  // {
  //   $response = $this->withRootUser()
  //     ->post('auth/user/role/fail/check');

  //   $response->assertStatus(403);
  // }
}
