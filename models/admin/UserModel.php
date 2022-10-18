<?php

namespace app\models\admin;

use app\core\db\DbModel;

class UserModel extends DbModel
{
  public string $fullName = '';
  public string $thumb = '';
  public string $username = '';
  public string $password = '';
  public string $phone = '';
  public string $email = '';
  public int $group_id = 0;

  public function tableName(): string
  {
    return "users";
  }

  public function labels(): array
  {
    return [
      'fullName' => 'Họ và tên',
      'thumb' => 'Ảnh đại diện',
      'username' => 'Tài khoản',
      'password' => 'Mật khẩu',
      'phone' => 'Số điện thoại',
      'email' => 'Email',
      'group_id' => 'Chọn nhóm quyền',
    ];
  }

  public function placeholder(): array
  {
    return [
      'fullName' => 'Nhập họ và tên',
      'thumb' => 'Chọn đại diện',
      'username' => 'Nhập tài khoản',
      'password' => 'Nhập mật khẩu',
      'phone' => 'Nhập số điện thoại',
      'email' => 'Nhập email',
      'group_id' => 'Chọn nhóm quyền',
    ];
  }

  public function rules(): array
  {
    return [
      'fullName' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4]],
      'thumb' => [self::RULE_REQUIRED],
      'username' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 5]],
      'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4], [self::RULE_MAX, 'max' => 32]],
      'phone' => [self::RULE_REQUIRED],
      'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
      'group_id' => [self::RULE_REQUIRED],
    ];
  }

  public function attributes(): array
  {
    return ['thumbName', 'thumb', 'username', 'password', 'phone', 'email', 'group_id'];
  }

  public function primaryKey(): string
  {
    return 'id';
  }
}
