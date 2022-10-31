<?php

namespace app\controllers\admin;

use app\core\Controller;
use app\models\admin\UserModel;

class Auth extends Controller
{
  private UserModel $user;

  public function __construct()
  {
    $this->user = new UserModel;
  }

  public function login()
  {

    if ($this->isPost()) {
      $this->user->loadData($this->getBody());
      $this->user->validate();

      $userLogin = $this->user->handleLogin();

      if ($userLogin) {
        if ((int)$userLogin->group_id === 1 || (int)$userLogin->group_id === 5) {
          $primaryKey = $this->user->primaryKey();
          $primaryValue = $userLogin->{$primaryKey};
          $_SESSION['user'] = $primaryValue;

          $_SESSION['data'] = [
            'message' => 'Đăng nhập thành công',
            'error' => false
          ];

          $this->redirect(BASE_URL . '/admin');
          exit;
        } else {
          $_SESSION['message_check_role'] = 'Bạn không có quyền đăng nhập vào hệ thống.';
        }
      }
    }

    $this->view("layoutLoginAdmin", [
      'title' => 'Đăng nhập',
      'page' => 'login',
      'content' => 'content',
      'css' => ['admin', 'index', 'input', 'toast'],
      'js' => ['input', 'auth'],
      'model' => $this->user,
    ]);
  }

  public function checkIsLogin()
  {
    if (!isset($_SESSION['user']))
      return true;
    return false;
  }

  public function logout()
  {
    unset($_SESSION['user']);
    $this->redirect(BASE_URL . "/admin/login");
  }
}
