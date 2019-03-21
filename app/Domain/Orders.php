<?php

namespace App\Domain;

use DB;

class Orders
{
  public function findById($id)
  {
    return DB::table('orders')->where('id', $id)->first();
  }

  public function userSearch($userId)
  {
    return DB::table('orders')
      ->where('user_id', $userId)
      ->orderBy('created_at', 'desc')
      ->get();
  }

  public function adminSearch()
  {
    return DB::table('orders')->get();
  }

  public function create($userId, $insert)
  {
    foreach ($insert as &$data) {
      $data['user_id'] = $userId;
    }

    DB::table('orders')->insert($insert);
  }

  public function delete($ids)
  {
    DB::table('orders')->whereIn('id', $ids)->delete();
  }

  public function update($ids, $data)
  {
    DB::table('orders')->whereIn('id', $ids)->update($data);
  }

  public function getUserId($id)
  {
    return DB::table('orders')
      ->where('id', $id)
      ->select(['user_id'])
      ->first()
      ->user_id;
  }

  // public function deleteById($ids)
  // {
  //   if (!is_array($ids)) {
  //     $ids = [$ids];
  //   }

  //   DB::table('orders')->whereIn('id', $ids)->delete();
  // }

  // public function update($ids, $update)
  // {
  //   if (!is_array($ids)) {
  //     $ids = [$ids];
  //   }

  //   DB::table('orders')->whereIn('id', $ids)->update($update);
  // }

  // public function log($ids, $method, $comment, $adminId = null)
  // {
  //   if (!is_array($ids)) {
  //     $ids = [$ids];
  //   }

  //   $insert = [];
  //   foreach ($ids as $id) {
  //     $insert = [
  //       'commodity_order_id' => $id,
  //       'method' => $method,
  //       'comment' => $comment,
  //       'admin_id' => $adminId
  //     ];
  //   }

  //   DB::table('commodity_order_logs')->insert($insert);
  // }

  // public function deleteLogsById($id)
  // {
  //   $where = ['commodity_order_id' => $id];

  //   DB::table('commodity_order_logs')->where($where)->delete();
  // }

  // public function getLogsById($id)
  // {
  //   $where = ['commodity_order_id' => $id];

  //   return DB::table('commodity_order_logs')
  //     ->orderBy('created_at')
  //     ->where($where)
  //     ->get();
  // }
}
