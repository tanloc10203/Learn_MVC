<?php

namespace app\controllers\admin;

use app\core\Controller;
use app\models\admin\UserModel;

class Auth extends Controller
{
  public function __construct()
  {
    $this->user = new UserModel;
  }

  public function login()
  {

    $this->view("layoutLoginAdmin", [
      'title' => 'Đăng nhập',
      'page' => 'login',
      'content' => 'content',
      'css' => ['admin', 'index', 'input'],
      'js' => ['input'],
      'model' => $this->user,
    ]);
  }

  public function logout()
  {
  }
}
