<?php

namespace App\controllers;

use App\components\QueryBuilder;
use League\Plates\Engine;
use Delight\Auth\Auth;

class HomeController {
  private $auth, $templates, $db;

  public function __construct(Auth $auth, Engine $engine, QueryBuilder $db) {
    $this->auth = $auth;
    $this->templates = $engine;
    $this->db = $db;
  }
  
  public function actionIndex() {
    $users = $this->db->getAll('users');
    echo $this->templates->render('index', ['users' => $users, 'auth' => $this->auth]);
  }

  public function actionLogin() {
    echo $this->templates->render('login', ['auth' => $this->auth]);
  }

  public function actionRegister() {
    echo $this->templates->render('register', ['auth' => $this->auth]);
  }

  public function actionProfile($id) {
    $user = $this->db->getOne('users', $id);
    echo $this->templates->render('user_profile', ['user' => $user, 'auth' => $this->auth]);
  }
}