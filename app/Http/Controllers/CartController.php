<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Transaction;
use App\Domain\Facades\Users;
use App\Domain\Facades\Carts;

class CartController extends Controller
{
  public function add()
  {
    $userId = Auth::user()->id;
    $insert = $this->get('data', 'array');
    $ids = Users::getCartIds($userId);
    $id = Carts::add($insert);
    $ids[] = $id;
    Users::updateCartIds($userId, $ids);

    return success_response([
      'data' => Carts::find($id),
      'message' => 'success_to_add_cart'
    ]);
  }

  public function search()
  {
    $userId = Auth::user()->id;
    $list = Users::getCartIds($userId);
    $data = Carts::getByIds($list);

    return [
      'list' => $list,
      'data' => $data
    ];
  }

  public function delete()
  {
    $userId = Auth::user()->id;
    $ids = $this->get('cart_ids');

    $newIds = array_values(
      array_diff(Users::getCartIds($userId), $ids)
    );

    Transaction::begin();
    Users::updateCartIds($userId, $newIds);
    Carts::delete($ids);
    Transaction::commit();

    return success_response('success_to_delete_cart_by_ids');
  }

  public function update()
  {
    $id = $this->get('id', 'required');
    $update = $this->get('data', 'required');

    Carts::update($id, $update);

    return success_response('success_to_update_cart');
  }
}
