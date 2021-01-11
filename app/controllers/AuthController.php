<?php 

namespace App\controllers;

use Delight\Auth\Auth;
use League\Plates\Engine;
use App\components\QueryBuilder;

class AuthController {
  private $auth, $templates, $db;

  public function __construct(Auth $auth, Engine $engine, QueryBuilder $db) {
    $this->auth = $auth;
    $this->templates = $engine;
    $this->db = $db;
  }

  public function actionLogin() {
    try {
      $this->auth->login($_POST['email'], $_POST['password'], 60 * 60 * 24 * 7);
      
      unset($_POST);
      header('Location: /user-' . $this->auth->getUserId());
    }
    catch (\Delight\Auth\InvalidEmailException $e) {
      $_SESSION['Wrong email or password!'];
    }
    catch (\Delight\Auth\InvalidPasswordException $e) {
      $_SESSION['Wrong email or password!'];
    }
    catch (\Delight\Auth\EmailNotVerifiedException $e) {
      $_SESSION['Email is not verified! Please verify your email to log in!'];
    }
    catch (\Delight\Auth\TooManyRequestsException $e) {
      $_SESSION['Too many requests!'];
    }
  }

  public function actionRegister() {
    $_SESSION['register_error'] = [];

    if ($_POST['password'] !== $_POST['password2']) 
      $_SESSION['register_error'][] = 'Повторно введите пароль!';

    if (!$_POST['agreement']) 
      $_SESSION['register_error'][] = 'Нужно согласие со всеми правилами!';

    try {
      $userId = $this->auth->register($_POST['email'], $_POST['password'], $_POST['username'], function ($selector, $token) {
        echo 'Send ' . $selector . ' and ' . $token . ' to the user (e.g. via email)';
      });
  
      echo 'We have signed up a new user with the ID ' . $userId;
    }
    catch (\Delight\Auth\InvalidEmailException $e) {
      $_SESSION['register_error'][] = 'Invalid email!';
    }
    catch (\Delight\Auth\InvalidPasswordException $e) {
      $_SESSION['register_error'][] = 'Invalid password!';
    }
    catch (\Delight\Auth\UserAlreadyExistsException $e) {
      $_SESSION['register_error'][] = 'This user already exists!';
    }
    catch (\Delight\Auth\TooManyRequestsException $e) {
      $_SESSION['register_error'][] = 'Too many requests!';
    }
    unset($_POST);
    header('Location: /register');
  }

  public function actionLogout() {
    $this->auth->logOut();
    header('Location: /');
  }

  public function actionChangePassword() {
    if ($this->auth->isLoggedIn()) {
      $user = $this->db->getOne('users', $this->auth->getUserId());
      echo $this->templates->render('changepassword', ['user' => $user]);
    } else {
      header('Location: /');
    }
  }

  public function actionUserEdit() {
    if ($this->auth->isLoggedIn()) {
      $user = $this->db->getOne('users', $this->auth->getUserId());
      echo $this->templates->render('user_edit', ['user' => $user]);
    } else {
      header('Location: /');
    }
  }

  public function actionUserUpdate() {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $status = $_POST['status_text'];

    $this->db->update('users', $id, ['username' => $username, 'status_text' => $status]);
    header('Location: user-' . $id);
  }
}