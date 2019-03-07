<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Transaction;
use App\Domain\Facades\Fees;
use App\Domain\Facades\Points;
use App\Domain\Facades\CommodityOrders as Orders;

class CommodityOrderController extends Controller
{
  /**
   * user
   */
  public function userSearch()
  {
    $id = Auth::user()->id;

    return Orders::userSearch($id);
  }

  public function create()
  {
    $insert = [
      'user_id' => Auth::user()->id,
      'name' => $this->get('name', 'nullable'),
      'comment' => $this->get('comment', 'nullable'),
      'outbound_method' => $this->get('outbound_method', 'required')
    ];
    $id = Orders::create($insert);

    return $this->success([
      'message' => 'success_to_create_commodity_order',
      'id' => $id
    ]);
  }

  public function delete()
  {
    $id = $this->get('id', 'required');
    Orders::deleteById($id);

    return $this->success('success_to_delete_commodity_order');
  }

  public function updateInboundLogisticId()
  {
    $id = $this->get('id', 'required');
    $logisticId = $this->get('logistic_id', 'required');
    $update = ['inbound_logistic_id' => $logisticId];
    Orders::update($id, $update);

    return $this->success('success_to_update_inbound_logistic_id');
  }

  public function abandon()
  {
    $id = $this->get('id', 'required');
    $update = ['is_abandoned_confirming' => true];
    Orders::update($id, $update);

    return $this->success('success_to_update_abandoning');
  }

  public function updateDiscrepant()
  {
    $id = $this->get('id', 'required');
    $update = ['is_discrepant_confirming' => true];
    Orders::update($id, $update);

    return $this->success('success_to_update_discrepant');
  }

  public function outboundIndividual()
  {
    $id = $this->get('id', 'required');
    $update = ['outbound_method' => 'individual'];
    Orders::update($id, $update);

    return $this->success('success_to_set_outbound_individual');
  }

  /**
   * admin
   */
  public function adminSearch()
  {
    return Orders::adminSearch();
  }

  public function inbound()
  {
    $id = $this->get('id', 'required');
    $update = ['is_inbound' => true];
    Orders::update($id, $update);

    return $this->success('success_to_inbound_commodity_order');
  }

  public function discrepant()
  {
    $id = $this->get('id', 'required');
    $update = ['is_discrepant' => true];
    Orders::update($id, $update);

    return $this->success('success_to_set_commodity_order_discrepant');
  }

  public function confirmAbandoned()
  {
    $id = $this->get('id', 'required');
    $update = ['is_discrepant' => false];
    Orders::update($id, $update);

    return $this->success('success_to_confirm_commodity_order_discrepant');
  }

  public function confirmDiscrepant()
  {
    $id = $this->get('id', 'required');
    $update = ['is_abandoned' => true];
    Orders::update($id, $update);

    return $this->success('success_to_set_commodity_order_abandoned');
  }

  public function outbound()
  {
    $id = $this->get('id', 'required');
    $update = ['is_outbound' => true];
    Orders::update($id, $update);

    return $this->success('success_to_set_individual_outbound_finished');
  }

  public function cancelOutbound()
  {
    $id = $this->get('id', 'required');
    $update = ['is_outbound' => false];
    Orders::update($id, $update);

    return $this->success('success_to_set_set_individual_outbound_unfinished');
  }
}
