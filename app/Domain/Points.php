<?php

namespace App\Domain;

use DB;
use Carbon\Carbon;

class Points
{
  public function findById($id)
  {
    return DB::table('point_orders')->where('id', $id)->first();
  }

  public function userSearch($userId)
  {
    return DB::table('point_orders')->where('user_id', $userId)->get();
  }

  public function adminSearch()
  {
    return DB::table('point_orders')->get();
  }

  public function createOrder($userId, $points, $insert = [])
  {
    $insert['user_id'] = $userId;
    $insert['points'] = $points;

    return DB::table('point_orders')->insertGetId($insert);
  }

  public function deleteOrderById($id)
  {
    DB::table('point_orders')->where('id', $id)->delete();
  }

  public function updateOrder($id, $update)
  {
    DB::table('point_orders')->where('id', $id)->update($update);
  }

  public function log($insert)
  {
    DB::table('point_logs')->insert($insert);
  }
}
