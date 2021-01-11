<?php $this->layout('layout', ['title' => 'Profile']) ?>

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
                <a href="user-<?= $user['id'] ?>" class="nav-link">Профиль</a>
              </li>
              <li class="nav-item">
                <a href="/logout" class="nav-link">Выйти</a>
              </li>
            </li>
          </ul>
        </div>
    </nav>

   <div class="container">
     <div class="row">
       <div class="col-md-8">
         <h1>Профиль пользователя - <?= $user['username'] ?></h1>
         <div class="alert alert-success">Профиль обновлен</div>
         
         <div class="alert alert-danger">
           <ul>
             <li>Ошибка валидации</li>
           </ul>
         </div>
         <ul>
           <li><a href="/changepassword">Изменить пароль</a></li>
         </ul>
         <form action="/user_update" method="POST" class="form">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <div class="form-group">
              <label for="username">Имя</label>
              <input type="text" name="username" id="username" class="form-control" value="<?= $user['username']; ?>">
            </div>
            <div class="form-group">
              <label for="status">Статус</label>
              <input type="text" name="status_text" id="status" class="form-control" value="<?= $user['status_text']; ?>">
            </div>

            <div class="form-group">
              <button name="user_edit" class="btn btn-warning">Обновить</button>
            </div>
         </form>


       </div>
     </div>
   </div>
</div>
