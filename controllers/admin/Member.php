<?php

namespace app\controllers\admin;

use app\core\Controller;
use app\models\admin\GroupRoleModel;
use app\models\admin\UserModel;

class Member extends Controller
{
  private UserModel $user;

  public function __construct()
  {
    $this->user = new UserModel;
  }

  public function index()
  {
    if ($this->isPost()) {
      $member = new UserModel();

      $member->loadData($this->getBody());

      $data = $member->getAll($this->getBody());

      $total = $member->count();

      $total_row = ceil($total / (int) $this->getBody()['limit']);

      exit(json_encode([
        'message' => 'GET ALL SUCCESS',
        'data' => $data,
        'total_rows' => $total_row,
        'path_img' => PUBLIC_PATH_USER_UPLOAD
      ]));
    }

    $this->view("layoutAdmin", [
      'title' => 'Thành viên',
      'page' => 'member',
      'css' => ['admin', 'index', 'toast'],
      'js' => ['member'],
      'content' => 'contentTable',
      'head_title' => 'Danh sách thành viên',
      'label_add' => 'Thêm thành viên',
      'component' => [
        'form' => ['name' => 'member'],
        'pagination' => ['name' => 'member'],
      ],
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

      if (count($model->errors) > 0)
        exit(json_encode([
          'error' => true,
          'message' => 'Error validate',
          'model' => $model
        ]));

      $model->save();

      $_SESSION['data'] = [
        'message' => 'Thêm thành viên thành công',
        'error' => false
      ];

      exit(json_encode([
        'error' => false,
        'message' => 'Success',
        'model' => $model
      ]));
    }

    $this->view("layoutAdmin", [
      'title' => 'Thêm thành viên',
      'page' => 'memberAdd',
      'css' => ['admin', 'index', 'member', 'input', 'toast'],
      'js' => ['input', 'member'],
      'content' => 'content',
      'model' => $model,
      'array_group_roles' => $group_roles->getAll(),
    ]);
  }

  public function update()
  {
    $model = new UserModel();
    $group_roles = new GroupRoleModel();

    $id = '';
    if (isset($_GET['id']))
      $id = $_GET['id'];

    $member = $model->findById((int)$id);

    if ($this->isPost()) {
      $data = $this->getBody();

      $img = '';

      if (isset($_FILES['thumb'])) {
        $model->thumb = $_FILES['thumb']['name'];
        $img = $this->processImg($_FILES['thumb']['name'], $_FILES['thumb']['tmp_name'], UPLOAD_USER_PATH);
      }

      if (!empty($img)) $data['thumb'] = $img;

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

      if (count($model->errors) > 0)
        exit(json_encode([
          'error' => true,
          'message' => 'Error validate',
          'model' => $model
        ]));

      $model->update($id);

      $_SESSION['data'] = [
        'message' => 'Cập nhật thành công',
        'error' => false
      ];

      exit(json_encode([
        'error' => false,
        'message' => 'Success',
        'model' => $model,
      ]));
    }

    $this->view("layoutAdmin", [
      'title' => 'Cập nhật thành viên',
      'page' => 'memberUpdate',
      'css' => ['admin', 'index', 'member', 'input', 'toast'],
      'content' => 'content',
      'js' => ['input', 'member'],
      'model' => $model,
      'member' => $member,
      'array_group_roles' => $group_roles->getAll(),
    ]);
  }

  public function delete()
  {
    $id = '';

    if (isset($_GET['id']))
      $id = $_GET['id'];

    if ($this->isPost()) {
      $category = new UserModel();

      $category->delete($id);

      exit(json_encode(['message' => 'Delete success', 'error' => false]));
    }
  }

  public function search()
  {
    if ($this->isPost()) {
      exit(json_encode(['message' => 'SEND DATA', 'data' => $this->getBody()]));
    }
  }

  public function pagination()
  {
    $page = "";

    if (isset($_GET['page'])) $page = $_GET['page'];

    if ($page === 'next')
      exit(json_encode(['page' => 'next']));
    else if ($page === 'prev')
      exit(json_encode(['page' => 'prev']));

    echo json_encode(['page' => (int)$page]);
  }

  public function getRoleUser()
  {
    if (isset($_SESSION['user'])) {
      $id = $_SESSION['user'];

      $sql = "SELECT g.role FROM `users` u JOIN `group_roles` g ON u.group_id = g.id WHERE u.id = $id";

      $user = $this->user->findOneAssoc($sql);

      return $user->role;
    }
  }
}
