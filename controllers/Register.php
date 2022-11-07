<?php

namespace app\controllers;

use app\core\Controller;
use app\models\admin\UserModel;

class Register extends Controller
{
  public function index()
  {
    $model = new UserModel();

    if ($this->isPost()) {
      $data = $this->getBody();
      $data['group_id'] = 2;
      $model->loadData($data);
      $attributes = $model->attributes();
      $rules = array();

      $attributes = array_filter($attributes, function ($val) use ($model) {
        return !empty($model->{$val});
      });

      foreach ($attributes as $attr) {
        $rules[$attr] = $model->rules()[$attr];
      }

      $model->validate($rules);

      if (count($model->errors) == 0) {
        $model->save();
        $_SESSION['message'] = [
          'title' => 'Success',
          'text' => 'Đăng ký thành công',
          'type' => 'success'
        ];
        $this->redirect(BASE_URL . "/login");
      }
    }

    $this->view('layoutMaster', [
      'page' => 'register',
      'title' => 'Đăng ký',
      'css' => ['index', 'input'],
      'js' => ['input'],
      'model' => $model
    ]);
  }
}
