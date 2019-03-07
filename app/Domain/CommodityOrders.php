<?php

namespace App\Domain;

use DB;
use Carbon\Carbon;

class CommodityOrders
{
  public function findById($id)
  {
    return DB::table('commodity_orders')->where('id', $id)->first();
  }

  public function userSearch($userId)
  {
    return DB::table('commodity_orders')->where('user_id', $userId)->get();
  }

  public function adminSearch()
  {
    return DB::table('commodity_orders')->get();
  }

  public function create($insert)
  {
    $id = DB::table('commodity_orders')->insertGetId($insert);

    return $id;
  }

  public function deleteById($ids)
  {
    if (!is_array($ids)) {
      $ids = [$ids];
    }

    DB::table('commodity_orders')->whereIn('id', $ids)->delete();
  }

  public function update($ids, $update)
  {
    if (!is_array($ids)) {
      $ids = [$ids];
    }

    DB::table('commodity_orders')->whereIn('id', $ids)->update($update);
  }

  public function log($ids, $method, $comment, $adminId = null)
  {
    if (!is_array($ids)) {
      $ids = [$ids];
    }

    $insert = [];
    foreach ($ids as $id) {
      $insert = [
        'commodity_order_id' => $id,
        'method' => $method,
        'comment' => $comment,
        'admin_id' => $adminId
      ];
    }

    DB::table('commodity_order_logs')->insert($insert);
  }

  public function deleteLogsById($id)
  {
    $where = ['commodity_order_id' => $id];

    DB::table('commodity_order_logs')->where($where)->delete();
  }

  public function getLogsById($id)
  {
    $where = ['commodity_order_id' => $id];

    return DB::table('commodity_order_logs')
      ->orderBy('created_at')
      ->where($where)
      ->get();
  }
}
