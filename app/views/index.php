<?php $this->layout('layout', ['title' => 'Home']) ?>

<div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="/">User Management</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="/">Главная</a>
          </li>
          <?php if ($auth->hasRole(0)): ?>
          <li class="nav-item">
            <a class="nav-link" href="/admin/users">Управление пользователями</a>
          </li>
          <?php endif; ?>
        </ul>

        <ul class="navbar-nav">
          <?php if ($auth->isLoggedIn()): ?>
          <li class="nav-item">
            <a href="/user-<?= $auth->getUserId(); ?>" class="nav-link">Мой профиль</a>
          </li>
          <li class="nav-item">
            <a href="/logout" class="nav-link">Выйти</a>
          </li>
          <?php else: ?>
          <li class="nav-item">
            <a href="/login" class="nav-link">Войти</a>
          </li>
          <li class="nav-item">
            <a href="/register" class="nav-link">Регистрация</a>
          </li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="jumbotron">
          <h1 class="display-4">Привет, мир!</h1>
          <p class="lead">Это дипломный проект по разработке на PHP. На этой странице список наших пользователей.</p>
          <hr class="my-4">
          <p>Чтобы стать частью нашего проекта вы можете пройти регистрацию.</p>
          <a class="btn btn-primary btn-lg" href="/register" role="button">Зарегистрироваться</a>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <h1>Пользователи</h1>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Имя</th>
              <th>Email</th>
              <th>Дата</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
              <td><?= $user['id']; ?></td>
              <td><a href="/user-<?= $user['id']; ?>"><?= $user['username']; ?></a></td>
              <td><?= $user['email']; ?></td>
              <td><?= date('m/d/Y', $user['registered']); ?></td>
            </tr>
            <?php endforeach; ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>