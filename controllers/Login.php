<?php

namespace app\controllers;

use app\core\Controller;
use app\models\admin\UserModel;

class Login extends Controller
{
  public function index()
  {
    $model = new UserModel();

    if ($this->isPost()) {
      $model->loadData($this->getBody());
      $model->validate();

      $userLogin = $model->handleLogin();

      if ($userLogin) {
        $primaryKey = $model->primaryKey();
        $primaryValue = $userLogin->{$primaryKey};
        $_SESSION['user_client'] = $primaryValue;

        $_SESSION['message'] = [
          'title' => 'Success',
          'text' => 'Đăng nhập thành công',
          'type' => 'success'
        ];

        $this->redirect(BASE_URL . '/');
      }
    }

    $this->view('layoutMaster', [
      'page' => 'login',
      'title' => 'Đăng nhập',
      'css' => ['index', 'input'],
      'js' => ['input'],
      'model' => $model
    ]);
  }
}
