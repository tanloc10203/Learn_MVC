<?php

namespace app\core\forms;

use app\core\Model;

class InputField extends BaseField
{
  public const TYPE_TEXT = 'text';
  public const TYPE_PASSWORD = 'password';
  public const TYPE_NUMBER = 'number';
  public const TYPE_EMAIL = 'email';
  public const TYPE_FILE = 'file';

  public Model $model;
  public string $type;
  public string $attribute;

  public function __construct(Model $model, string $attribute)
  {
    $this->type = self::TYPE_TEXT;
    parent::__construct($model, $attribute);
  }

  public function passwordField()
  {
    $this->type = self::TYPE_PASSWORD;
    return $this;
  }

  public function numberField()
  {
    $this->type = self::TYPE_NUMBER;
    return $this;
  }

  public function emailField()
  {
    $this->type = self::TYPE_EMAIL;
    return $this;
  }

  public function fileField()
  {
    $this->type = self::TYPE_FILE;
    return $this;
  }

  public function renderInput(): string
  {
    return sprintf(
      '<input id="%s" name="%s" value="%s" type="%s" class="form-control %s" placeholder="%s">',
      $this->attribute,
      $this->attribute,
      $this->model->{$this->attribute},
      $this->type,
      $this->model->hasError($this->attribute) ? 'is-invalid' : '',
      $this->model->getPlaceholder($this->attribute),
    );
  }
}
