<?php $this->layout('layout', ['title' => 'Change password']) ?>

<div class="wrapper">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">User Management</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="/">Главная</a>
        </li>
        <?php if ($auth->hasRole(\Delight\Auth\Role::ADMIN)): ?>
        <li class="nav-item">
          <a class="nav-link" href="/admin/users">Управление пользователями</a>
        </li>
        <?php endif; ?>
      </ul>

      <ul class="navbar-nav">
        <li class="nav-item">
          <li class="nav-item">
            <a href="profile.html" class="nav-link">Профиль</a>
          </li>
          <a href="/logout" class="nav-link">Выйти</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h1>Изменить пароль</h1>
        <div class="alert alert-success">Пароль обновлен</div>
        
        <div class="alert alert-danger">
          <ul>
            <li>Ошибка валидации</li>
          </ul>
        </div>
        <ul>
          <li><a href="profile.html">Изменить профиль</a></li>
        </ul>
        <form action="" class="form">
          <div class="form-group">
            <label for="current_password">Текущий пароль</label>
            <input type="password" id="current_password" class="form-control">
          </div>
          <div class="form-group">
            <label for="current_password">Новый пароль</label>
            <input type="password" id="current_password" class="form-control">
          </div>
          <div class="form-group">
            <label for="current_password">Повторите новый пароль</label>
            <input type="password" id="current_password" class="form-control">
          </div>

          <div class="form-group">
            <button class="btn btn-warning">Изменить</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>