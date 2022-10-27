<?php

namespace app\models\admin;

use app\core\db\DbModel;

class GroupRoleModel extends DbModel
{

  public function tableName(): string
  {
    return "group_roles";
  }

  public function attributes(): array
  {
    return ['role'];
  }

  public function primaryKey(): string
  {
    return "id";
  }

  public function rules(): array
  {
    return [];
  }

  public function labels(): array
  {
    return [];
  }

  public function placeholder(): array
  {
    return [];
  }
}
