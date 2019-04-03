<?php

namespace Tests\Domain;

use App\Domain\Facades\Series;

class SeriesTest extends TestCase
{
  public function testGenerate()
  {
    $value = Series::generate('test');
    $this->assertTrue(true);
  }

  public function testFind()
  {
    $seriel = Series::find('test');
    $this->assertNotNull($seriel);
  }
}
