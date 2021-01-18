<?php

namespace App\models;

use App\components\QueryBuilder;

class Users {
  private $db;

  public function __construct(QueryBuilder $db) {
    $this->db = $db;
  }

  public function getUserById($id) {
    return $this->db->getOne('users', $id);
  }

  public function getAllUsers() {
    return $this->db->getAll('users');
  }

  public function editUserById($id, $data) {
    $this->db->update('users', $id, $data);
  }

  public function deleteUserById($id) {
    $this->db->delete('users', $id);
  }
}