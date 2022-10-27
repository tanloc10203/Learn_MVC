<?php

namespace app\core\forms;

use app\core\Model;

abstract class BaseField
{
  public Model $model;
  public string $attribute;

  public function __construct(Model $model, string $attribute)
  {
    $this->model = $model;
    $this->attribute = $attribute;
  }

  abstract public function renderInput(): string;

  public function __toString()
  {
    return sprintf(
      '
    <div class="mb-3 form-group">
      <label class="form-label" for="%s">%s</label>
      <div class="input-custom">
        %s
        <div class="invalid-feedback">
          %s
        </div>
      </div>
      </div>
    ',
      $this->attribute,
      $this->model->getLabel($this->attribute),
      $this->renderInput(),
      $this->model->getFirstError($this->attribute),
    );
  }
}
