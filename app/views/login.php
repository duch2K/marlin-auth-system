<?php $this->layout('layout', ['title' => 'Log in']) ?>

<div class="wrapper text-center">
  <form action="/login" method="POST" class="form-signin">
    <img class="mb-4" src="images/apple-touch-icon.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>

    <div class="alert alert-danger">
      <ul>
        <li>Ошибка валидации 1</li>
        <li>Ошибка валидации 2</li>
        <li>Ошибка валидации 3</li>
      </ul>
    </div>

    <div class="alert alert-info">
      Логин или пароль неверны
    </div>

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

