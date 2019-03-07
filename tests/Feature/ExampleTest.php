<?php

namespace Tests\Feature;

class ExampleTest extends TestCase
{
	public function testBasicTest()
	{
		$response = $this->get('/');

		$response->assertStatus(200);
	}
}
