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
  $r->addRoute('POST', '/login', ['App\controllers\AuthController', 'actionLogin']);
  $r->addRoute('GET', '/register', ['App\controllers\HomeController', 'actionRegister']);
  $r->addRoute('POST', '/register', ['App\controllers\AuthController', 'actionRegister']);
  $r->addRoute('GET', '/logout', ['App\controllers\AuthController', 'actionLogout']);
  $r->addRoute('GET', '/user-edit', ['App\controllers\AuthController', 'actionUserEdit']);
  $r->addRoute('POST', '/user-update', ['App\controllers\AuthController', 'actionUserUpdate']);
  $r->addRoute('GET', '/changepass', ['App\controllers\AuthController', 'actionChangePassword']);
  $r->addRoute('GET', '/user-{id:\d+}', ['App\controllers\AuthController', 'actionProfile']);
  $r->addRoute('GET', '/admin/users', ['App\controllers\HomeController', 'actionUsersAdmin']);
  $r->addRoute('GET', '/admin/user-edit', ['App\controllers\HomeController', 'actionUserEditAdmin']);
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
