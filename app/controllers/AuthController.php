<?php 

namespace App\controllers;

use Delight\Auth\Auth;
use Delight\Auth\Role;
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
      
      header('Location: /user-' . $this->auth->getUserId());die;
    }
    catch (\Delight\Auth\InvalidEmailException $e) {
      $_SESSION['login_error'] = 'Wrong email or password!';
    }
    catch (\Delight\Auth\InvalidPasswordException $e) {
      $_SESSION['login_error'] = 'Wrong email or password!';
    }
    catch (\Delight\Auth\EmailNotVerifiedException $e) {
      $_SESSION['login_error'] = 'Email is not verified! Please verify your email to log in!';
    }
    catch (\Delight\Auth\TooManyRequestsException $e) {
      $_SESSION['login_error'] = 'Too many requests!';
    }

    header('Location: /login');die;
  }

  public function actionRegister() {
    $_SESSION['register_error'] = [];

    if ($_POST['password'] !== $_POST['password2']) {
      $_SESSION['register_error'][] = 'Повторно введите пароль!';
      header('Location: /register');die;
    }

    if (!$_POST['agreement']) {
      $_SESSION['register_error'][] = 'Нужно согласие со всеми правилами!';
      header('Location: /register');die;
    }

    try {
      $userId = $this->auth->register($_POST['email'], $_POST['password'], $_POST['username'], function ($selector, $token) {
        try {
          $this->auth->confirmEmail($selector, $token);
        }
        catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
          die('Не валидный токен!');
        }
        catch (\Delight\Auth\TokenExpiredException $e) {
          die('Токен просрочен!');
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
          die('Этот email уже существует!');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
          die('Слишком много запросов!');
        }
      });
      $_SESSION['register_success'] = true;
      echo 'We have signed up a new user with the ID ' . $userId;
    }
    catch (\Delight\Auth\InvalidEmailException $e) {
      $_SESSION['register_error'][] = 'Не правильный email!';
    }
    catch (\Delight\Auth\InvalidPasswordException $e) {
      $_SESSION['register_error'][] = 'Невалидный пароль!';
    }
    catch (\Delight\Auth\UserAlreadyExistsException $e) {
      $_SESSION['register_error'][] = 'Этот пользователь уже существует!';
    }
    catch (\Delight\Auth\TooManyRequestsException $e) {
      $_SESSION['register_error'][] = 'Слишком много запросов!';
    }
    header('Location: /register');die;
  }

  public function actionLogout() {
    $this->auth->logOut();
    header('Location: /');die;
  }

  public function actionChangePassword() {
    if ($this->auth->isLoggedIn()) {
      $user = $this->db->getOne('users', $this->auth->getUserId());
      echo $this->templates->render('changepassword', ['user' => $user, 'auth' => $this->auth]);
    } else {
      header('Location: /');die;
    }
  }

  public function actionUserEdit() {
    if ($this->auth->isLoggedIn()) {
      $user = $this->db->getOne('users', $this->auth->getUserId());
      echo $this->templates->render('user_edit', ['user' => $user, 'auth' => $this->auth]);
    } else {
      header('Location: /');die;
    }
  }

  public function actionAdminUserEdit($id) {
    if ($this->auth->isLoggedIn() and $this->auth->hasRole(Role::ADMIN)) {
      $user = $this->db->getOne('users', $id);
      echo $this->templates->render('admin/user_edit', ['user' => $user, 'auth' => $this->auth]);
    } else {
      header('Location: /');die;
    }
  }

  public function actionUserUpdate() {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $status = $_POST['status_text'];

    if (strlen($status) > 255)
      $_SESSION['user_update_error'] = 'Статус слишком длинный!';
    else {
      $this->db->update('users', $id, ['username' => $username, 'status_text' => $status]);
      $_SESSION['user_update_success'] = true;
    }

    header('Location: /user-edit');die;
  }
}