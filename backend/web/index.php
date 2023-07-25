<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;
use App\config\Database;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;

$dotenv = Dotenv::createMutable(dirname(__DIR__, 2));
$dotenv->load();

new Database();

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', 'handleDefault');
    $r->addRoute('POST', '/', 'handleDefault');
    $r->addRoute('GET', '/{controller}/{action}', 'handle');
    $r->addRoute('POST', '/{controller}/{action}', 'handle');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        echo '404 err';
        break;
    case Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo '405 err';
        break;
    case Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        call_user_func($handler, $vars);
        break;
}

/**
 * @param $vars
 * @return void
 */
function handle($vars)
{
    $controller = 'App\\controller\\' . ucfirst($vars['controller']) . 'Controller';
    $action = 'action' . $vars['action'];

    if (class_exists($controller) && method_exists($controller, $action)) {
        call_user_func_array([new $controller(), $action], [$_GET]);
    } else {
        echo '404 err';
    }
}

/**
 * @param $vars
 * @return void
 */
function handleDefault($vars)
{
    $controller = 'App\\controller\\SiteController';
    $action = 'actionIndex';

    if (class_exists($controller) && method_exists($controller, $action)) {
        call_user_func_array([new $controller(), $action], [$_GET]);
    } else {
        echo '404 err';
    }
}
