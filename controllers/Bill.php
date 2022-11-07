<?php

namespace app\controllers;

use app\core\Controller;
use app\models\CartModel;

class Bill extends Controller
{
  private CartModel $bill;

  public function __construct()
  {
    $this->bill = new CartModel;
  }

  public function index()
  {
    $bills = $this->bill->getByUserId($_SESSION['user_client']);

    $this->view('layoutMaster', [
      'page' => 'bill',
      'title' => 'Đơn hàng',
      'css' => ['index', 'product'],
      'bills' => $bills
    ]);
  }
}
