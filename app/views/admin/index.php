<?php $this->layout('layout', ['title' => 'Admin']) ?>

<div class="wrapper">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">User Management</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Главная</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Управление пользователями</a>
        </li>
      </ul>

      <ul class="navbar-nav">
        <li class="nav-item">
          <li class="nav-item">
            <a href="profile.html" class="nav-link">Профиль</a>
          </li>
          <a href="#" class="nav-link">Выйти</a>
        </li>
      </ul>
    </div>
</nav>

  <div class="container">
    <div class="col-md-12">
      <h1>Пользователи</h1>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Действия</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>1</td>
            <td>Rahim</td>
            <td>rahim@marlindev.ru</td>
            <td>
              <a href="#" class="btn btn-success">Назначить администратором</a>
              <a href="#" class="btn btn-info">Посмотреть</a>
              <a href="#" class="btn btn-warning">Редактировать</a>
              <a href="#" class="btn btn-danger" onclick="return confirm('Вы уверены?');">Удалить</a>
            </td>
          </tr>

          <tr>
            <td>2</td>
            <td>John</td>
            <td>john@marlindev.ru</td>
            <td>
              <a href="#" class="btn btn-danger">Разжаловать</a>
              <a href="#" class="btn btn-info">Посмотреть</a>
              <a href="#" class="btn btn-warning">Редактировать</a>
              <a href="#" class="btn btn-danger" onclick="return confirm('Вы уверены?');">Удалить</a>
            </td>
          </tr>

          <tr>
            <td>3</td>
            <td>Jane</td>
            <td>jane@marlindev.ru</td>
            <td>
              <a href="#" class="btn btn-success">Назначить администратором</a>
              <a href="#" class="btn btn-info">Посмотреть</a>
              <a href="#" class="btn btn-warning">Редактировать</a>
              <a href="#" class="btn btn-danger" onclick="return confirm('Вы уверены?');">Удалить</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>  
</div>
