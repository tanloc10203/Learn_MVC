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
  public string $hidden;

  public function __construct(Model $model, string $attribute, bool $hidden = false)
  {
    $this->type = self::TYPE_TEXT;
    $this->hidden = $hidden;
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
      '<input id="%s" name="%s" value="%s" type="%s" class="form-control %s" placeholder="%s" %s %s> 
      %s
      ',
      $this->attribute,
      $this->attribute,
      $this->model->{$this->attribute},
      $this->type,
      $this->model->hasError($this->attribute) ? 'is-invalid' : '',
      $this->model->getPlaceholder($this->attribute),
      $this->hidden ? 'hidden' : '',
      $this->type === self::TYPE_FILE ? 'onchange="readURL(this)"' : null,
      $this->type === self::TYPE_PASSWORD ? $this->iconShowPassword() : null,

    );
  }

  public function iconShowPassword()
  {
    return '
      <div class="input-custom__icon" id="show__pw">
        <i class="fa-solid fa-eye"></i>
      </div>
    ';
  }
}
