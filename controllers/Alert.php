<?php

namespace app\controllers;

use app\core\Controller;
use app\models\CartModel;

class Alert extends Controller
{
  private CartModel $cart;

  public function __construct()
  {
    $this->cart = new CartModel;
  }

  public function billSuccess()
  {
    if (isset($_SESSION['bill_success'])) {

      $array_bill = array();

      foreach ($_SESSION['bill_success'] as $key => $id) {
        array_push($array_bill, $this->cart->getById($id));
      }

      unset($_SESSION['bill_success']);

      $this->view('layoutMaster', [
        'page' => 'alert',
        'css' => ['index'],
        'title' => 'Thanh toán thành công',
        'data' => $array_bill
      ]);
    }
  }
}
