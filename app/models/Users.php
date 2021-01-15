<?php

namespace App\models;

use App\components\QueryBuilder;

class Users {
  private static $db;

  public function __construct(QueryBuilder $db) {
    self::$db = $db;
  }

  public static function getUserById($id) {
    return self::$db->getOne('users', $id);
  }

  public static function getAllUsers() {
    return self::$db->getAll('users');
  }

  public static function editUserById($id, $data) {
    self::$db->update('users', $id, $data);
  }

  public static function deleteUserById($id) {
    self::$db->delete('users', $id);
  }
}