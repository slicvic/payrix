<?php

error_reporting(0);

define('BASEPATH', realpath(__DIR__ . '/../../') . '/');
define('APPPATH', BASEPATH . 'App/');
define('VIEWPATH', APPPATH . 'views/');

require_once BASEPATH . 'vendor/autoload.php';

$controllerName = !empty($_GET['c']) ? strtolower(trim($_GET['c'])) : 'index';
$actionName = !empty($_GET['a']) ? strtolower(trim($_GET['a'])) : 'index';
$controllerClassName = "\\App\\Controllers\\" . ucfirst($controllerName) . 'Controller';
$actionMethodName = $actionName . 'Action';

if (!class_exists($controllerClassName)) {
    http_response_code(404);
    die('Page not found');
}

$reflection = new ReflectionClass($controllerClassName);
if (!$reflection->isInstantiable()) {
    http_response_code(404);
    die('Page not found');
}

$controllerInstance = new $controllerClassName;

if (!is_callable([$controllerInstance, $actionMethodName])) {
    http_response_code(404);
    die('Page not found');
}

try {
    $dotenv = new \Dotenv\Dotenv(APPPATH);
    $dotenv->load();

    $response = (string) $controllerInstance->$actionMethodName();
    die($response);
}
catch (Throwable $t) {
    http_response_code(500);
    die('Server error');
}
catch (Exception $e) {
    http_response_code(500);
    die('Server error');
}
