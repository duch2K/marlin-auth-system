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
            <a class="nav-link" href="#">Главная</a>
          </li>
        </ul>

        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="#" class="nav-link">Войти</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Регистрация</a>
          </li>
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
               <td>2</td>
               <td>Джон</td>
               <td>25/02/2025</td>
               <td>Привет! Я новый пользователь вашего проекта, хочу перейти на уровень 3!</td>
             </tr>
           </tbody>
         </table>


       </div>
     </div>
   </div>
</div>