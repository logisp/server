<?php

namespace Tests\Feature;

use Test;
use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
  protected function withRootUser()
  {
    $token = Test::user()->token;

    return $this->withHeader('Authorization', $token);
  }

  protected function withRootAdmin()
  {
    $token = Test::admin()->token;

    return $this->withHeader('Authorization', $token);
  }
}
