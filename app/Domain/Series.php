<?php

namespace App\Domain;

use DB;

class Series
{
  public function create($name, $begin = 1, $minStep = 1, $maxStep = 10)
  {
    DB::table('series')->insert([
      'name' => $name,
      'begin' => $begin,
      'value' => $begin,
      'min_step' => $minStep,
      'max_step' => $maxStep
    ]);
  }

  public function delete($name)
  {
    DB::table('series')->where('name', $name)->delete();
  }

  public function generate($name)
  {
    $sql = 'update series set count = count + 1, value = '
      . 'value + floor(random() * (max_step - min_step) + min_step)'
      . 'where name = ? returning value';
    $id = DB::select($sql, [$name])[0]->value;

    return $id;
  }

  public function generateUserId()
  {
    return $this->generate('user_id');
  }

  public function find($name)
  {
    return DB::table('series')->where('name', $name)->first();
  }
}
