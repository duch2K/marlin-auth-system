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

    } else {
      header('Location: /');die;
    }
  }

  public function actionDeleteUser($id) {

  }

  public function actionMakeAdmin($id) {

  }
}