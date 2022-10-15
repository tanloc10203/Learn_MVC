<?php

namespace app\models\admin;

use app\core\db\DbModel;

class CategoryModel extends DbModel
{
  public string $name = '';

  public function tableName(): string
  {
    return "categories";
  }

  public function labels(): array
  {
    return [
      'name' => 'Tên danh mục',
    ];
  }

  public function placeholder(): array
  {
    return [
      'name' => 'Nhập vào tên danh mục ...',
    ];
  }

  public function rules(): array
  {
    return [
      'name' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4]],
    ];
  }

  public function attributes(): array
  {
    return ['name'];
  }

  public function primaryKey(): string
  {
    return 'id';
  }
}
