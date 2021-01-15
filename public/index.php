<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

if( !session_id() ) @session_start();

require '../vendor/autoload.php';

use App\components\QueryBuilder;
use DI\ContainerBuilder;
use League\Plates\Engine;
use Delight\Auth\Auth;


// DI
$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
  Engine::class => function() {
    return new Engine('../app/views');
  },

  PDO::class => function() {
    $driver = 'mysql';
    $host = 'localhost';
    $dbName = 'my_test_db';
    $user = 'root';
    $password = 'root';

    return new PDO("$driver:host=$host;dbname=$dbName", $user, $password);
  },

  Auth::class => function($container) {
    return new Auth($container->get('PDO'));
  },

  QueryBuilder::class => function($container) {
    return new QueryBuilder($container->get('PDO'));
  }
]);
$container = $containerBuilder->build();


// Routing
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
  $r->addRoute('GET', '/', ['App\controllers\HomeController', 'actionIndex']);
  $r->addRoute('GET', '/login', ['App\controllers\HomeController', 'actionLogin']);
  $r->addRoute('GET', '/register', ['App\controllers\HomeController', 'actionRegister']);
  $r->addRoute('GET', '/user-{id:\d+}', ['App\controllers\HomeController', 'actionProfile']);
  $r->addRoute('GET', '/admin', ['App\controllers\HomeController', 'actionAdmin']);
  $r->addRoute('GET', '/edit-user', ['App\controllers\HomeController', 'actionEditUser']);
  $r->addRoute('GET', '/changepass', ['App\controllers\HomeController', 'actionChangePassword']);
  
  $r->addRoute('GET', '/logout', ['App\controllers\AuthController', 'actionLogout']);
  $r->addRoute('POST', '/login', ['App\controllers\AuthController', 'actionLogin']);
  $r->addRoute('POST', '/register', ['App\controllers\AuthController', 'actionRegister']);
  $r->addRoute('POST', '/edit-user', ['App\controllers\AuthController', 'actionEditUser']);
  
  $r->addRoute('POST', '/admin/edit-user/{id:\d+}', ['App\controllers\AdminController', 'actionEditUser']);
  $r->addRoute('POST', '/admin/delete-user/{id:\d+}', ['App\controllers\AdminController', 'actionDeleteUser']);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
  $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
  case FastRoute\Dispatcher::NOT_FOUND:
    echo '404';
    break;
  case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
    $allowedMethods = $routeInfo[1];
    echo 'Method not allowed!';
    break;
  case FastRoute\Dispatcher::FOUND:
    $handler = $routeInfo[1];
    $vars = $routeInfo[2];
    
    $container->call($routeInfo[1], $routeInfo[2]);
    break;
}
