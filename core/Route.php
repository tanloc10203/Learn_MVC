<?php

namespace app\core;

class Route
{
  public static function list(): array
  {
    return [
      [
        'value' => 'home',
        'url' => '/',
        'label' => 'Trang chủ'
      ],
      [
        'value' => 'department',
        'url' => '/department',
        'label' => 'Khoa'
      ],
      [
        'value' => 'classes',
        'url' => '/classes',
        'label' => 'Lớp'
      ],
      [
        'value' => 'student',
        'url' => '/student',
        'label' => 'Sinh viên'
      ],
      [
        'value' => 'manageTeacher',
        'url' => '/manageTeacher',
        'label' => 'Quản lý giảng viên'
      ],
      [
        'value' => 'manageSubject',
        'url' => '/manageSubject',
        'label' => 'Quản lý môn học'
      ],
      [
        'value' => 'manageMark',
        'url' => '/manageMark',
        'label' => 'Quản lý điểm'
      ],
      [
        'value' => 'manageAttendance',
        'url' => '/manageAttendance',
        'label' => 'Quản lý điểm danh'
      ],
      [
        'value' => 'member',
        'url' => '/member',
        'label' => 'Thành viên'
      ],
      [
        'value' => 'roleMember',
        'url' => '/roleMember',
        'label' => 'Vai trò thành viên'
      ],

    ];
  }
}
