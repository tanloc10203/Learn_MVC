<?php

namespace app\controllers;

use app\core\Controller;
use app\models\CartModel;
use app\models\admin\UserModel;

class Checkout extends Controller
{
  private UserModel $user;
  private CartModel $cart;

  public function __construct()
  {
    $this->user = new UserModel;
    $this->cart = new CartModel;
  }

  public function index()
  {
    $cart = $this->getCart();
    $user = $this->getUser();

    if ($this->isPost()) {
      if (empty($_POST['phone']) || empty($_POST['address'])) {
        $_SESSION['error'] = 'Vui lòng chọn thay đổi địa chỉ để thanh toán.';
      }

      $user_id = $_SESSION['user_client'];
      $data_product = $_SESSION['cart']['buy'];
      $status_id = 1;
      $arr_id = array();

      foreach ($data_product as $item) {
        $id = $this->cart->create([
          'quantity' => $item['quantity'],
          'user_id' => $user_id,
          'product_id' => $item['id'],
          'status_id' => $status_id
        ]);

        array_push($arr_id, $id);
      }

      unset($_SESSION['cart']);
      $_SESSION['bill_success'] = $arr_id;
      $this->redirect(BASE_URL . '/alert/billSuccess');
    }

    $this->view('layoutMaster', [
      'page' => 'checkout',
      'title' => 'Thanh toán',
      'css' => ['index', 'checkout'],
      'cart' => $cart,
      'user' => $user,
    ]);
  }

  private function getCart()
  {
    if (isset($_SESSION['cart'])) {
      return $_SESSION['cart'];
    }

    return [];
  }

  private function getUser()
  {
    if (!isset($_SESSION['user_client'])) {
      return $this->redirect(BASE_URL . '/login');
    }

    return $this->user->findById((int) $_SESSION['user_client']);
  }
}
