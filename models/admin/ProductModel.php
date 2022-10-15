<?php

namespace app\models\admin;

use app\core\db\DbModel;

class ProductModel extends DbModel
{
  public int $id = -1;
  public int $price = -1;
  public string $name = '';
  public string $description = '';
  public int $category_id = -1;

  public function tableName(): string
  {
    return "product";
  }

  public function labels(): array
  {
    return [
      'fullName' => 'Họ và tên',
      'username' => 'Tài khoản',
      'password' => 'Mật khẩu',
    ];
  }

  public function rules(): array
  {
    return [
      'fullName' => [self::RULE_REQUIRED],
      'username' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4]],
      'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 32]],
    ];
  }

  public function attributes(): array
  {
    return ['fullName', 'password', 'username'];
  }

  public function primaryKey(): string
  {
    return 'id';
  }
}
