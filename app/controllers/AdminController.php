<?php

namespace App\controllers;

use Delight\Auth\Auth;
use Delight\Auth\Role;
use League\Plates\Engine;
use App\components\QueryBuilder;

class AdminController {
  private $templates, $auth, $db;

  public function __construct(Auth $auth, Engine $engine, QueryBuilder $db) {
    $this->auth = $auth;
    $this->templates = $engine;
    $this->db = $db;
  }

  public function actionEditUser($id) {
    if ($this->auth->isLoggedIn() and $this->auth->hasRole(Role::ADMIN)) {
      $user = $this->db->getOne('users', $id);
      echo $this->templates->render('admin/user_edit', ['user' => $user, 'auth' => $this->auth]);
    } else {
      header('Location: /');die;
    }
  }

  public function actionDeleteUser($id) {

  }

  public function actionMakeAdmin($id) {

  }
}