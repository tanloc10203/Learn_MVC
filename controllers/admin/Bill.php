<?php

namespace app\controllers\admin;

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
    $bills = $this->bill->getAll();

    $this->view('layoutAdmin', [
      'page' => 'bill',
      'content' => 'content',
      'css' => ['index', 'product'],
      'js' => ['bill'],
      'title' => 'Quản lý đơn hàng',
      'bills' => $bills
    ]);
  }

  public function update()
  {
    $status_id = (int) $_POST['status_id'] + 1;
    $id = (int) $_POST['id'];
    $this->bill->updateStatus($status_id, $id);
    $this->redirect(BASE_URL . '/admin/bill');
  }
}
