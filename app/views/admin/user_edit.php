<?php $this->layout('layout', ['title' => 'Admin edit']) ?>

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
     <div class="row">
       <div class="col-md-8">
         <h1>Профиль пользователя - <?= $user['username']; ?></h1>
         
         <?php 
          if (isset($_SESSION['user_update_error'])): ?>
            <div class="alert alert-danger">
              <ul>
                <li><?= $_SESSION['user_update_error']; ?></li>
              </ul>
            </div>
            <?php unset($_SESSION['user_update_error']); 
          elseif (isset($_SESSION['user_update_success'])): ?>
            <div class="alert alert-success">Профиль обновлен</div>
            <?php unset($_SESSION['user_update_success']); 
          endif;?>

         <form action="" class="form">
           <div class="form-group">
             <label for="username">Имя</label>
             <input type="text" id="username" class="form-control" value="<?= $user['username']; ?>">
           </div>
           <div class="form-group">
             <label for="status">Статус</label>
             <input type="text" id="status" class="form-control" value="<?= $user['status_text']; ?>">
           </div>

           <div class="form-group">
             <button type="submit" class="btn btn-warning">Обновить</button>
           </div>
         </form>
       </div>
     </div>
   </div>
</div>
