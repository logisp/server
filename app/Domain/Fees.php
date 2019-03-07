<?php

namespace App\Domain;

use DB;

class Fees
{
  public function all()
  {
    return DB::table('fees')->get();
  }

  public function getByName($name)
  {
    return DB::table('fees')->where('name', $name)->first();
  }

  public function create($name, $points, $comment = null)
  {
    $insert = [
      'name' => $name,
      'points' => $points,
      'comment' => $comment
    ];
    $id = DB::table('fees')->insertGetId($insert);

    return $id;
  }

  public function deleteByName($name)
  {
    DB::table('fees')->where('name', $name)->delete();
  }

  public function updatePoints($name, $points)
  {
    $where = ['name' => $name];
    $update = ['points' => $points];
    DB::table('fees')->where('name', $name)->update($update);
  }

  public function updateComment($name, $comment)
  {
    $where = ['name' => $name];
    $update = ['comment' => $comment];
    DB::table('fees')->where($where)->update($update);
  }
}
