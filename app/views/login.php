<?php $this->layout('layout', ['title' => 'Log in']) ?>

<div class="wrapper text-center">
  <form action="/login" method="POST" class="form-signin">
    <a href="/"><img class="mb-4" src="images/apple-touch-icon.png" alt="" width="72" height="72"></a>
    <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>

    <?php if (isset($_SESSION['login_error'])): ?>
    <div class="alert alert-danger">
      <ul>
        <li><?= $_SESSION['login_error']; ?></li>
      </ul>
    </div>
    <?php endif; unset($_SESSION['login_error']); ?>

    <div class="form-group">
      <input name="email" type="email" class="form-control" id="email" placeholder="Email">
    </div>
    <div class="form-group">
      <input name="password" type="password" class="form-control" id="password" placeholder="Пароль">
    </div>

    <div class="checkbox mb-3">
      <label>
        <input name="remember" type="checkbox"> Запомнить меня
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
  </form>
</div>

