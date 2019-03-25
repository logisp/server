<?php

namespace App\Http\Controllers;

use Auth;
use Transaction;
use App\Domain\Facades\Fees;

class FeeController extends Controller
{
  public function all()
  {
    return Fees::all();
  }

  public function updatePoints()
  {
    $adminId = Auth::account()->id;
    $name = $this->get('name', 'required');
    $points = $this->get('points', 'required');
    $comment = $this->get('comment', 'nullable');

    Transaction::begin();
    Fees::updatePoints($name, $points);
    Fees::log([
      'admin_id' => $adminId,
      'name' => $name,
      'points' => $points,
      'comment' => $comment
    ]);
    Transaction::commit();

    return $this->success('success_to_adjust_points');
  }

  public function searchLogs()
  {
    $page = $this->get('page', 'nullable|numeric', 1);
    $perPage = $this->get('perPage', 'nullable|numeric', 20);
    $name = $this->get('name', 'nullable');

    return Fees::getFeeLogs($page, $perPage, $name);
  }
}
