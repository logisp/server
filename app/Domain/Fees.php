<?php

namespace App\Domain;

use DB;

class Fees
{
  public function all()
  {
    return DB::table('fees')->get();
  }

  public function create($insert)
  {
    DB::table('fees')->insert($insert);
  }

  public function delete($name)
  {
    DB::table('fees')->where('name', $name)->delete();
  }

  public function updatePoints($name, $points)
  {
    $update = ['points' => $points];
    DB::table('fees')->where('name', $name)->update($update);
  }

  public function updateComment($name, $comment)
  {
    $update = ['comment' => $comment];
    DB::table('fees')->where('name', $name)->update($update);
  }

  public function log($insert)
  {
    DB::table('fee_logs')->insert($insert);
  }

  public function getFeeLogs($page = 1, $perPage = 10, $name = null)
  {
    $query = DB::table('fee_logs')
      ->select(DB::raw('count(*)'));
    $name && $query->where('name', $name);
    $total = $query->pluck('count')->first();

    $query = DB::table('fee_logs')
      ->orderBy('created_at', 'desc')
      ->limit($perPage)
      ->offset($perPage * ($page - 1));
    $name && $query->where('name', $name);

    return [
      'data' => $query->get(),
      'perPage' => $perPage,
      'total' => $total,
      'page' => $page,
    ];
  }

  public function deleteFeeLogs($name)
  {
    $res = DB::table('fee_logs')->where('name', $name)->delete();
  }
}
