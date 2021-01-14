<?php $this->layout('layout', ['title' => 'User profile']) ?>

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
          <?php if ($auth->hasRole(0)): ?>
          <li class="nav-item">
            <a class="nav-link" href="/admin/users">Управление пользователями</a>
          </li>
          <?php endif; ?>
        </ul>

        <ul class="navbar-nav">
          <?php if (intval($user['id']) === $auth->getUserId() and $auth->isLoggedIn()): ?>
          <li class="nav-item">
            <a href="/user-edit" class="nav-link">Редактировать профиль</a>
          </li>
          <li class="nav-item">
            <a href="/logout" class="nav-link">Выйти</a>
          </li>
          <?php elseif ($user['id'] !== $auth->getUserId() and $auth->isLoggedIn()): ?>
          <li class="nav-item">
            <a href="/user-<?= $auth->getUserId(); ?>" class="nav-link">Мой профиль</a>
          </li>
          <li class="nav-item">
            <a href="/register" class="nav-link">Выйти</a>
          </li>
          <?php else: ?>
          <li class="nav-item">
            <a href="/login" class="nav-link">Регистрация</a>
          </li>
          <li class="nav-item">
            <a href="/register" class="nav-link">Войти</a>
          </li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>

   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <h1>Данные пользователя</h1>
         <table class="table">
           <thead>
             <th>ID</th>
             <th>Имя</th>
             <th>Дата регистрации</th>
             <th>Статус</th>
           </thead>

           <tbody>
             <tr>
               <td><?= $user['id']; ?></td>
               <td><?= $user['username']; ?></td>
               <td><?= date('m/d/Y', $user['registered']); ?></td>
               <td><?= $user['status_text']; ?></td>
             </tr>
           </tbody>
         </table>


       </div>
     </div>
   </div>
</div>