<?php

namespace app\controllers;

use app\core\Controller;
use app\models\admin\UserModel;

class Address extends Controller
{
  private UserModel $user;

  public function __construct()
  {
    $this->user = new UserModel;
  }

  public function change()
  {
    $error = '';
    $data = array();


    if ($this->isPost()) {
      if (empty($_POST['address'])) {
        $error = 'Vui lòng chọn địa chỉ';
      } else {
        $data['address'] = $_POST['address'];
      }

      if (!empty($_POST['phone'])) {
        if (!is_numeric($_POST['phone']))
          $error = 'Số điện thoại không đúng định dạng';
        else if (!preg_match('/^0[0-9]{9}$/', $_POST['phone']))
          $error = 'Vui lòng nhập đúng số điện thoại';
        else
          $data['phone'] = $_POST['phone'];
      }

      if (count($data) > 0) {
        $this->user->updateAddress((int) $_SESSION['user_client'], $data);
        $this->redirect(BASE_URL . '/checkout');
      }
    }

    $this->view('layoutMaster', [
      'page' => 'changeAddress',
      'title' => 'Thay đổi địa chỉ',
      'css' => ['index'],
      'js' => ['address'],
      'error' => $error,
      'data' => $data
    ]);
  }
}
