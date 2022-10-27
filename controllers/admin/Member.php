<?php

namespace app\controllers\admin;

use app\core\Controller;
use app\models\admin\GroupRoleModel;
use app\models\admin\UserModel;

class Member extends Controller
{
  public function index()
  {
    $member = new UserModel();

    $this->view("layoutAdmin", [
      'title' => 'Thành viên',
      'page' => 'member',
      'css' => ['admin', 'index'],
      'content' => 'contentTable',
      'head_title' => 'Danh sách thành viên',
      'label_add' => 'Thêm thành viên',
      'component' => [
        'form' => ['name' => 'member'],
        'pagination' => ['name' => 'member'],
      ],
      'data_member' => $member->getAll()
    ]);
  }

  public function add()
  {
    $model = new UserModel();
    $group_roles = new GroupRoleModel();


    if ($this->isPost()) {
      $model->thumb = $_FILES['thumb']['name'];

      $img = $this->processImg($_FILES['thumb']['name'], $_FILES['thumb']['tmp_name'], UPLOAD_USER_PATH);

      $data = $this->getBody();
      $data['thumb'] =  $img;

      $model->loadData($data);
      $model->validate();

      if (count($model->errors) === 0) {
        $model->save();

        $_SESSION['data'] = [
          'message' => 'Thêm thành công',
          'error' => false
        ];

        $this->redirect("/admin/member");
      }
    }

    $this->view("layoutAdmin", [
      'title' => 'Thêm thành viên',
      'page' => 'memberAdd',
      'css' => ['admin', 'index', 'member', 'input'],
      'js' => ['toast', 'input'],
      'content' => 'content',
      'model' => $model,
      'array_group_roles' => $group_roles->getAll(),
    ]);
  }
}
