<?php $this->layout('layout', ['title' => 'Registration']) ?>

<div class="wrapper text-center">
  <form action="/register" method="POST" class="form-signin">
      <a href="/"><img class="mb-4" src="images/apple-touch-icon.png" alt="" width="72" height="72"></a>
      <h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>

      <?php if (isset($_SESSION['register_error']) and count($_SESSION['register_error']) > 0): ?>
      <div class="alert alert-danger">
        <ul>
          <?php foreach ($_SESSION['register_error'] as $err): ?>
          <li><?= $err; ?></li>
          <?php endforeach; unset($_SESSION['register_error']); ?>
        </ul>
      </div>
      <?php elseif (isset($_SESSION['register_success']) and $_SESSION['register_success']): ?>
      <div class="alert alert-success">
        Успешный успех
      </div>
      <?php unset($_SESSION['register_success']); endif; ?>

      <div class="form-group">
        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
      </div>
      <div class="form-group">
        <input type="text" name="username" class="form-control" id="email" placeholder="Ваше имя">
      </div>
      <div class="form-group">
        <input type="password" name="password" class="form-control" id="password" placeholder="Пароль">
      </div>
      
      <div class="form-group">
        <input type="password" name="password2" class="form-control" id="password" placeholder="Повторите пароль">
      </div>

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" name="agreement"> Согласен со всеми правилами
        </label>
      </div>
      <button name="register" class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
  </form>
</div>
