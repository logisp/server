<?php

namespace Tests\Feature;

class CommodityOrderTest extends TestCase
{
	public function testCreate()
	{
		$response = $this->withRootUser()
			->post('commodity/order/create', [
				'name' => 'test_commodity_order',
				'comment' => 'test_commodity_order_comment',
				'outbound_method' => 'fba'
			]);

		$response->assertStatus(201);

		return $response->decodeResponseJson()['id'];
	}

	/**
	 * @depends testCreate
	 */
	public function testUpdateInboundLogisticId($id)
	{
		$response = $this->withRootUser()
			->post('commodity/order/inbound/logistic/update', [
				'id' => $id,
				'logistic_id' => '123456789'
			]);

		$response->assertStatus(201);
	}

	/**
	 * @depends testCreate
	 */
	public function testAbandon($id)
	{
		$response = $this->withRootUser()
			->post('commodity/order/abandon', ['id' => $id]);
		$response->assertStatus(201);
	}

	/**
	 * @depends testCreate
	 */
	public function testUpdateDiscrepant($id)
	{
		$response = $this->withRootUser()
			->post('commodity/order/discrepant/update', ['id' => $id]);
		$response->assertStatus(201);
	}

	/**
	 * @depends testCreate
	 */
	public function testOutboundIndividual($id)
	{
		$response = $this->withRootUser()
			->post('commodity/order/outbound/individual', ['id' => $id]);
		$response->assertStatus(201);
	}

	/**
	 * @depends testCreate
	 */
	public function testInbound($id)
	{
		$response = $this->withRootAdmin()
			->post('commodity/order/inbound', ['id' => $id]);
		$response->assertStatus(201);
	}

	/**
	 * @depends testCreate
	 */
	public function testDiscrepant($id)
	{
		$response = $this->withRootAdmin()
			->post('commodity/order/discrepant', ['id' => $id]);
		$response->assertStatus(201);
	}

	/**
	 * @depends testCreate
	 */
	public function testAbandonConfirm($id)
	{
		$response = $this->withRootAdmin()
			->post('commodity/order/abandon/confirm', ['id' => $id]);
		$response->assertStatus(201);
	}

	/**
	 * @depends testCreate
	 */
	public function testDiscrepantConfirm($id)
	{
		$response = $this->withRootAdmin()
			->post('commodity/order/discrepant/confirm', ['id' => $id]);
		$response->assertStatus(201);
	}

	/**
	 * @depends testCreate
	 */
	public function testOutbound($id)
	{
		$response = $this->withRootAdmin()
			->post('commodity/order/outbound', ['id' => $id]);
		$response->assertStatus(201);
	}

	/**
	 * @depends testCreate
	 */
	public function testCancelOutbound($id)
	{
		$response = $this->withRootAdmin()
			->post('commodity/order/outbound/cancel', ['id' => $id]);
		$response->assertStatus(201);
	}

	public function testUserSearch()
	{
		$response = $this->withRootUser()
			->post('commodity/orders/user/search');
		// dd($response->decodeResponseJson());
		$response->assertStatus(200);
	}

	public function testAdminSearch()
	{
		$response = $this->withRootAdmin()
			->post('commodity/orders/admin/search');
		// dd($response->decodeResponseJson());
		$response->assertStatus(200);
	}

	/**
	 * @depends testCreate
	 */
	public function testDelete($id)
	{
		$response = $this->withRootUser()
			->post('commodity/order/delete', ['id' => $id]);

		$response->assertStatus(201);
	}
}
