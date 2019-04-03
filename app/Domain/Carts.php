<?php

namespace App\Domain;

use DB;

class Carts
{
  public function find($id)
  {
    return DB::table('carts')->where('id', $id)->first();
  }

  public function getByIds($ids)
  {
    return DB::table('carts')->whereIn('id', $ids)->get();
  }

  public function add($insert = [])
  {
    $insert['id'] = $this->genreateId();
    return DB::table('carts')->insertGetId($insert);
  }

  public function update($id, $update)
  {
    return DB::table('carts')->where('id', $id)->update($update);
  }

  public function delete(array $ids)
  {
    return DB::table('carts')->whereIn('id', $ids)->delete();
  }

  protected function genreateId()
  {
    return Facades\Series::generate('cart_id');
  }
}
