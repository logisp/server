<?php

namespace App\Domain;

use DB;
use Carbon\Carbon;

class Points
{
  public function add($userId, $increments)
  {
    DB::table('users')->where('id', $userId)->update([
      'points' => DB::raw("points + $increments")
    ]);
  }

  public function searchUserLogs($userId, $type = null)
  {
    $query = DB::table('user_point_logs')->where('user_id', $userId);
    $type && $query->where('type', 'like', $type . '%');

    return $query->miniPaginate();
  }

  public function log($insert)
  {
    return DB::table('user_point_logs')->insert($insert);
  }

  public function logGetId($insert)
  {
    return DB::table('user_point_logs')->insertGetId($insert);
  }

  public function logPurchase($userId, $increments)
  {
    return $this->logGetId([
      'type' => 'purchase',
      'user_id' => $userId,
      'increments' => $increments
    ]);
  }

  public function logConsumption($userId, $orderId, $type, $increments)
  {
    return $this->logGetId([
      'user_id' => $userId,
      'order_id' => $orderId,
      'increments' => $increments,
      'type' => 'consumption.' . $type
    ]);
  }

  public function logAdjustment($userId, $adminId, $increments)
  {
    return $this->logGetId([
      'user_id' => $userId,
      'admin_id' => $adminId,
      'type' => 'adjustment',
      'increments' => $increments
    ]);
  }

  public function deleteLogs($ids)
  {
    if (!is_array($ids)) {
      $ids = [$ids];
    }

    DB::table('user_point_logs')->whereIn('id', $ids)->delete();
  }
}
