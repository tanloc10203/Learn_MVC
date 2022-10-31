<?php

namespace app\models\admin;

use app\core\db\DbModel;

class ProductModel extends DbModel
{
  public string $price = '';
  public string $name = '';
  public string $thumb = '';
  public string $category_id = '';

  public function tableName(): string
  {
    return "products";
  }

  public function labels(): array
  {
    return [
      'name' => 'Tên sản phẩm',
      'price' => 'Giá sản phẩm',
      'thumb' => 'Ảnh sản phẩm',
      'category_id' => 'Danh mục',
    ];
  }

  public function placeholder(): array
  {
    return [
      'name' => 'Nhập tên sản phẩm',
      'price' => 'Nhập giá sản phẩm',
      'thumb' => 'Chọn ảnh',
      'category_id' => 'Chọn danh mục',
    ];
  }

  public function rules(): array
  {
    return [
      'name' => [self::RULE_REQUIRED],
      'thumb' => [self::RULE_REQUIRED],
      'price' => [self::RULE_REQUIRED, self::RULE_NUMBER],
      'category_id' => [self::RULE_REQUIRED],
    ];
  }

  public function attributes(): array
  {
    return ['name', 'price', 'thumb', 'category_id'];
  }

  public function primaryKey(): string
  {
    return 'id';
  }
}
