<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Transaction;
use App\Domain\Facades\Users;
use App\Domain\Facades\Points;

class PointController extends Controller
{
  public function userSearchOrders()
  {
    $id = Auth::user()->id;

    return Points::userSearch($id);
  }

  public function adminSearchOrders()
  {
    return Points::adminSearch();
  }
  
  public function userCreateOrder()
  {
    $userId = Auth::user()->id;
    $points = $this->get('points', 'required');
    $insert = ['is_confirming' => true];

    $id = Points::createOrder($userId, $points, $insert);

    return $this->success([
      'message' => 'success_to_create_point_order',
      'id' => $id
    ]);
  }

  public function adminConfirmOrder()
  {
    $id = $this->get('id', 'required');
    $adminId = Auth::admin()->id;

    $update = [
      'is_filed' => true,
      'is_passed' => true,
      'is_recorded' => true,
      'is_confirming' => false,
      'confirmer_id' => $adminId,
      'filed_at' => DB::raw('now()'),
      'passed_at' => DB::raw('now()'),
      'recorded_at' => DB::raw('now()'),
    ];

    $order = Points::findById($id);

    Transaction::begin();
    Points::updateOrder($id, $update);
    Users::updateUser($order->user_id, ['points' => $order->points]);
    Transaction::commit();

    return $this->success('success_to_confirm_point_order');
  }

  public function userRecharge()
  {
    $userId = Auth::user()->id;
    $points = $this->get('points', 'required');
    $insert = [
      'is_filed' => true,
      'is_passed' => true,
      'is_recorded' => true,
      'confirmer_id' => 0,
      'filed_at' => DB::raw('now()'),
      'passed_at' => DB::raw('now()'),
      'recorded_at' => DB::raw('now()'),
    ];

    Transaction::begin();
    $id = Points::createOrder($userId, $points, $insert);
    Users::updateUser($userId, ['points' => $points]);
    Transaction::commit();

    return $this->success([
      'message' => 'success_to_recharge_points',
      'id' => $id
    ]);
  }

  public function adminAdjust()
  {
    $adminId = Auth::admin()->id;
    $points = $this->get('points', 'required');
    $userId = $this->get('user_id', 'required');
    $insert = [
      'admin_id' => $adminId,
      'is_filed' => true,
      'is_passed' => true,
      'is_recorded' => true,
      'confirmer_id' => $adminId,
      'filed_at' => DB::raw('now()'),
      'passed_at' => DB::raw('now()'),
      'recorded_at' => DB::raw('now()')
    ];

    Transaction::begin();
    $id = Points::createOrder($userId, $points, $insert);
    Users::updateUser($userId, ['points' => $points]);
    Transaction::commit();

    return $this->success([
      'message' => 'success_to_adjust_points',
      'id' => $id
    ]);
  }

  public function deleteOrder()
  {
    $id = $this->get('id', 'required');

    Points::deleteOrderById($id);

    return $this->success('success_to_delete_order');
  }
}
