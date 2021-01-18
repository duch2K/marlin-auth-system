<?php

namespace App\controllers;

use App\models\Users;
use Delight\Auth\Auth;
use Delight\Auth\Role;
use League\Plates\Engine;

class AdminController {
  private $templates, $auth, $usersModel;

  public function __construct(Auth $auth, Engine $engine, Users $users) {
    $this->auth = $auth;
    $this->templates = $engine;
    $this->usersModel = $users;
  }

  public function actionEditUser($id) {
    $user = $this->usersModel->getUserById($id);

    if ($this->auth->isLoggedIn() and $this->auth->hasRole(Role::ADMIN)) 
      echo $this->templates->render('admin/user_edit', ['user' => $user, 'auth' => $this->auth]);

    else
      header('Location: /');die;
  }

  public function actionDeleteUser($id) {
    if ($this->auth->isLoggedIn() and $this->auth->hasRole(Role::ADMIN)) {
      $this->usersModel->deleteUserById($id);
      header('Location: /admin');die;

    } else 
      header('Location: /');die;
  }

  public function actionMakeAdmin($id) {
    $user = $this->usersModel->getUserById($id);

    if ($this->auth->isLoggedIn() and $this->auth->hasRole(Role::ADMIN) and $user['roles_mask'] !== 1) {
      $this->usersModel->editUserById($id, ['roles_mask' => Role::ADMIN]);
      header('Location: /admin');die;
    } else
      header('Location: /');die;
  }

  public function actionDemoteUser($id) {
    $user = $this->usersModel->getUserById($id);

    if ($this->auth->isLoggedIn() and $this->auth->hasRole(Role::ADMIN) and $user['roles_mask'] !== 1) {
      $this->usersModel->editUserById($id, ['roles_mask' => 0]);
      header('Location: /admin');die;
    } else
      header('Location: /');die;
  }
}