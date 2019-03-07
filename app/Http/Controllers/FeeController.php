<?php

namespace App\Http\Controllers;

use App\Domain\Facades\Fees;

class FeeController extends Controller
{
  public function create()
  {
    $name = $this->get('name', 'required');
    $points = $this->get('points', 'required');
    $comment = $this->get('comment', 'required');

    Fees::create($name, $points, $comment);

    return $this->success('success_to_create_fee');
  }

  public function delete()
  {
    $name = $this->get('name', 'required');
    Fees::deleteByName($name);

    return $this->success('success_to_delete_fee');
  }

  public function updatePoints()
  {
    $name = $this->get('name', 'required');
    $points = $this->get('points', 'required');

    Fees::updatePoints($name, $points);

    return $this->success('success_to_adjust_points');
  }

  public function updateComment()
  {
    $name = $this->get('name', 'required');
    $comment = $this->get('comment', 'required');

    Fees::updateComment($name, $comment);

    return $this->success('success_to_update_comment');
  }
}
