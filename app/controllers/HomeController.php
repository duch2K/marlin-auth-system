<?php

namespace App\controllers;

use Delight\Auth\Auth;
use Delight\Auth\Role;
use League\Plates\Engine;
use App\models\Users;

class HomeController {
  private $auth, $templates, $usersModel;

  public function __construct(Auth $auth, Engine $engine, Users $users) {
    $this->auth = $auth;
    $this->templates = $engine;
    $this->usersModel = $users;
  }
  
  public function actionIndex() {
    $users = $this->usersModel->getAllUsers();
    echo $this->templates->render('index', ['users' => $users, 'auth' => $this->auth]);
  }

  public function actionLogin() {
    echo $this->templates->render('login', ['auth' => $this->auth]);
  }

  public function actionRegister() {
    echo $this->templates->render('register', ['auth' => $this->auth]);
  }

  public function actionProfile($id) {
    $user = $this->usersModel->getUserById($id);
    if ($user)
      echo $this->templates->render('user_profile', ['user' => $user, 'auth' => $this->auth]);
      
    else
      header('Location: /');die;
  }

  public function actionEditUser() {
    if ($this->auth->isLoggedIn()) {
      $user = $this->usersModel->getUserById($this->auth->getUserId());
      echo $this->templates->render('user_edit', ['user' => $user, 'auth' => $this->auth]);

    } else {
      header('Location: /');die;
    }
  }

  public function actionChangePassword() {
    if ($this->auth->isLoggedIn()) {
      $user = $this->usersModel->getUserById($this->auth->getUserId());
      echo $this->templates->render('changepassword', ['user' => $user, 'auth' => $this->auth]);

    } else {
      header('Location: /');die;
    }
  }

  public function actionAdmin() {
    if ($this->auth->isLoggedIn() and $this->auth->hasRole(Role::ADMIN)) {
      $users = $this->usersModel->getAllUsers();
      echo $this->templates->render('admin/index', ['users' => $users, 'auth' => $this->auth]);

    } else {
      header('Location: /');die;
    }
  }
}