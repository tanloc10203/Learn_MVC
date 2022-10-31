<?php

namespace app\core;

use app\core\db\Database;

abstract class Model extends Database
{
  public const RULE_REQUIRED = 'required';
  public const RULE_EMAIL = 'email';
  public const RULE_MIN = 'min';
  public const RULE_MAX = 'max';
  public const RULE_MATCH = 'match';
  public const RULE_UNIQUE = 'unique';
  public const RULE_PHONE = 'phone';
  public const RULE_NUMBER = 'number';

  public array $errors = [];

  abstract public function rules(): array;

  abstract public function labels(): array;

  abstract public function placeholder(): array;

  public function loadData($data)
  {
    foreach ($data as $key => $value) {
      if (property_exists($this, $key)) {
        $this->{$key} = $value;
      }
    }
  }

  public function getLabel($attribute)
  {
    return $this->labels()[$attribute] ?? $attribute;
  }

  public function getPlaceholder($attribute)
  {
    return $this->placeholder()[$attribute] ?? $attribute;
  }

  public function validate($input_rules = [])
  {
    $result_rules = $this->rules();

    if (count($input_rules) > 0)
      $result_rules = $input_rules;

    foreach ($result_rules as $attribute => $rules) {
      $value = $this->{$attribute};

      foreach ($rules as $rule) {
        $ruleName = $rule;

        if (!is_string($ruleName)) {
          $ruleName = $rule[0];
        }

        if ($ruleName === self::RULE_REQUIRED && !$value) {
          $this->addErrorForRule($attribute, self::RULE_REQUIRED);
        }

        if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
          $this->addErrorForRule($attribute, self::RULE_EMAIL);
        }

        if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
          $this->addErrorForRule($attribute, self::RULE_MIN, $rule);
        }

        if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
          $this->addErrorForRule($attribute, self::RULE_MAX, $rule);
        }

        if ($ruleName === self::RULE_PHONE && !preg_match('/^0[0-9]{9}$/', $value)) {
          $this->addErrorForRule($attribute, self::RULE_PHONE);
        }

        if ($ruleName === self::RULE_NUMBER && !is_numeric($value)) {
          $this->addErrorForRule($attribute, self::RULE_NUMBER);
        }

        if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
          $rule['match'] = $this->getLabel($rule['match']);
          $this->addErrorForRule($attribute, self::RULE_MATCH, $rule);
        }
      }
    }

    return empty($this->errors);
  }

  private function addErrorForRule(string $attribute, string $rule, $params = [])
  {
    $message = $this->errorMessage()[$rule] ?? '';

    foreach ($params as $key => $value) {
      $message = str_replace("{{$key}}", $value, $message);
    }
    $this->errors[$attribute][] = $message;
  }

  public function addError(string $attribute, string $message)
  {
    $this->errors[$attribute][] = $message;
  }

  public function errorMessage()
  {
    return [
      self::RULE_REQUIRED => 'Đây là trường bắt buộc',
      self::RULE_EMAIL => 'Trường này phải là địa chỉ email hợp lệ.',
      self::RULE_MIN => 'Độ dài tối thiểu của trường này phải là {min}.',
      self::RULE_MAX => 'Độ dài tối đa của trường này phải là {max}.',
      self::RULE_MATCH => 'Trường này phải giống với {match}.',
      self::RULE_UNIQUE => 'Bản ghi với {field} này đã tồn tại.',
      self::RULE_PHONE => 'Số điện thoại không hợp lệ',
      self::RULE_NUMBER => 'Trường này phải là chữ số',
    ];
  }

  public function hasError($attribute)
  {
    return $this->errors[$attribute] ?? false;
  }

  public function getFirstError($attribute)
  {
    return $this->errors[$attribute][0] ?? false;
  }
}
