<?php

use Delight\Auth\Role;

$this->layout('layout', ['title' => 'Admin']) ?>

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
        <li class="nav-item">
          <a class="nav-link" href="/admin">Управление пользователями</a>
        </li>
      </ul>

      <ul class="navbar-nav">
        <li class="nav-item">
          <li class="nav-item">
            <a href="/user-<?= $auth->getUserId(); ?>" class="nav-link">Мой профиль</a>
          </li>
          <a href="/logout" class="nav-link">Выйти</a>
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
          <?php foreach ($users as $user): ?>
          <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['email'] ?></td>
            <td>
              <?php if (intval($user['roles_mask']) !== \Delight\Auth\Role::ADMIN): ?>
                <a href="/admin/make-admin/<?=$user['id'];?>" class="btn btn-success">Назначить администратором</a>
              <?php else: ?>
                <a href="/admin/demote/<?=$user['id'];?>" class="btn btn-danger">Разжаловать</a>
              <?php endif; ?>
              <a href="user-<?= $user['id']; ?>" class="btn btn-info">Посмотреть</a>
              <a href="/admin/edit-user/<?=$user['id'];?>" class="btn btn-warning">Редактировать</a>
              <a href="/admin/delete-user/<?=$user['id'];?>" class="btn btn-danger" onclick="return confirm('Вы уверены?');">Удалить</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>  
</div>
