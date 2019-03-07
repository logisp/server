<?php

namespace Tests\Unit;

use DB;
use Transaction;

class TransactionTest extends TestCase
{
  public function testBasicTest()
  {
    Transaction::begin();
    Transaction::commit();

    $this->assertTrue(true);
  }
}
