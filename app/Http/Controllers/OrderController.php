<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Transaction;
use Carbon\Carbon;
use App\Domain\Facades\Users;
use App\Domain\Facades\Carts;
use App\Domain\Facades\Points;
use App\Domain\Facades\Orders;

class OrderController extends Controller
{
  /**
   * user
   */
  public function userSearch()
  {
    $userId = Auth::user()->id;

    return Orders::userSearch($userId);
  }

  public function createFromCart()
  {
    $userId = Auth::user()->id;
    $cartIds = $this->get('cart_ids');
    $carts = Carts::getByIds($cartIds);
    $insert = [];
    foreach ($carts as $key => &$item) {
      unset($item->id);
      $insert[$key] = (array) $item;
    }
    $newIds = array_values(
      array_diff(Users::getCartIds($userId), $cartIds)
    );

    Transaction::begin();
    Orders::create($userId, $insert);
    Users::updateCartIds($userId, $newIds);
    Carts::delete($cartIds);
    Transaction::commit();

    return success_response('success_to_order_from_cart');
  }

  public function post()
  {
    $orderIds = $this->get('order_ids');

    Orders::update($orderIds, [
      'status' => 'inbounding',
      'logistic_id' => $this->get('logistic_id', 'required'),
      'logistic_inc' => $this->get('logistic_inc', 'nullable')
    ]);

    return success_response('success_to_update_posting_information');
  }

  public function confirming()
  {
    $orderIds = $this->get('order_ids');

    Orders::update($orderIds, [
      'status' => 'confirming',
      'user_remark' => $this->get('user_remark')
    ]);

    return success_response('success_to_update_confirming_information');
  }

  public function abandon()
  {
    $orderIds = $this->get('order_ids');

    Orders::update($orderIds, [
      'status' => 'abandoning'
    ]);

    return success_response('success_to_update_abandoning_information');
  }

  public function delete()
  {
    $orderIds = $this->get('order_ids');
    Orders::delete($orderIds);

    return success_response('success_to_delete_order');
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
    $orderIds = $this->get('order_ids');
    $remark = $this->get('inbound_remark');
    $isUnexpected = $this->get('is_unexpected_inbounded', 'nullable', false);

    Orders::update($orderIds, [
      'status' => 'inbounded',
      'is_unexpected_inbounded' => $isUnexpected,
      'inbound_remark' => $remark,
      'inbounded_at' => Carbon::now()
    ]);

    return success_response('success_to_update_inbound_information');
  }

  public function confirm()
  {
    $orderIds = $this->get('order_ids');
    $confirmed = $this->get('confirmed');

    Orders::update($orderIds, [
      'admin_remark' => $this->get('admin_remark'),
      'checked_remark' => $this->get('checked_remark'),
      'appendant_remark' => $this->get('appendant_remark'),
      'status' => $confirmed ? 'confirmed' : 'unexpected',
    ]);

    return success_response('success_to_update_confirmed_information');
  }

  public function abandoned()
  {
    $orderIds = $this->get('order_ids');

    Orders::update($orderIds, [
      'status' => 'filed',
      'is_abandoned' => true
    ]);

    return success_response('success_to_update_abandoned_information');
  }
}
