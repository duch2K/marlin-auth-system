<?php 

namespace App\controllers;

use Delight\Auth\Auth;
use League\Plates\Engine;

class AuthController {
  private $auth, $templates;

  public function __construct(Auth $auth, Engine $engine) {
    $this->auth = $auth;
    $this->templates = $engine;
  }
  
  public function actionProfile() {
    if ($this->auth->isLoggedIn()) {
      echo $this->templates->render('user_profile', ['auth' => $this->auth]);
    } else {
      header('Location: /');
    }
  }

  public function actionLogin() {
    try {
      $this->auth->login($_POST['email'], $_POST['password']);
      
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
      $_SESSION['register_error'][] = 'Confirm password!';

    if ($_POST['agreement']) 
      $_SESSION['register_error'][] = 'Confirm agreement!';

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

    header('Location: /register');
  }

  public function actionLogout() {
    $this->auth->logOut();
    header('Location: /');
  }
}