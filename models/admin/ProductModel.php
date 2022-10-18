<?php

namespace app\models\admin;

use app\core\db\DbModel;

class ProductModel extends DbModel
{
  public int $price = 0;
  public string $name = '';
  public string $thumb = '';
  public string $description = '';
  public int $category_id = -1;
  public string $detail_product = '';

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
      'description' => 'Giới thiệu sản phẩm',
      'category_id' => 'Danh mục',
      'detail_product' => 'Chi Tiết sản phẩm',
    ];
  }

  public function placeholder(): array
  {
    return [
      'name' => 'Nhập tên sản phẩm',
      'price' => 'Nhập giá sản phẩm',
      'thumb' => 'Chọn ảnh',
      'description' => 'Nhập giới thiệu sản phẩm',
      'category_id' => 'Chọn danh mục',
      'detail_product' => 'Nhập chi Tiết sản phẩm',
    ];
  }

  public function rules(): array
  {
    return [
      'name' => [self::RULE_REQUIRED],
      'thumb' => [self::RULE_REQUIRED],
      'price' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4]],
      'description' => [self::RULE_REQUIRED],
      'category_id' => [self::RULE_REQUIRED],
      'detail_product' => [self::RULE_REQUIRED],
    ];
  }

  public function attributes(): array
  {
    return ['name', 'price', 'thumb', 'description', 'category_id', 'detail_product'];
  }

  public function primaryKey(): string
  {
    return 'id';
  }
}
