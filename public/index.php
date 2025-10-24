<?php

require_once __DIR__ . '/../routes/web.php';
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Session;

Session::iniciar();

function view($view, $data = [])
{
    extract($data);
    require_once __DIR__ . '/../resources/views/' . $view . '.php';
}

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod === 'POST' && isset($_POST['_method'])) {
    $requestMethod = strtoupper($_POST['_method']);
}

$basePath = '/';
$uri = $requestUri; // Começa com a URI completa
if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}
$uri = trim($uri, '/');

$routeFound = false;

foreach ($routes[$requestMethod] ?? [] as $route => $handler) {
    $route = trim($route, '/');
    $pattern = preg_replace('/\{([^}]+)\}/', '([^/]+)', $route);

    if (preg_match('#^' . $pattern . '$#', $uri, $matches)) {
        $routeFound = true;
        array_shift($matches);

        if (is_string($handler) && strpos($handler, '@') !== false) {
            [$controller, $method] = explode('@', $handler);

            $controllerFile = __DIR__ . '/../app/Controllers/' . $controller . '.php';

            if (!file_exists($controllerFile)) {
                die("Controller não encontrado: $controllerFile");
            }

            require_once $controllerFile;

            $controllerClass = "App\\Controllers\\" . $controller;

            if (!class_exists($controllerClass)) {
                die("Classe do controller não encontrada: $controllerClass");
            }

            $controllerInstance = new $controllerClass();

            if (!method_exists($controllerInstance, $method)) {
                die("Método não encontrado: $method no controller $controllerClass");
            }

            call_user_func_array([$controllerInstance, $method], $matches);
        } elseif (is_callable($handler)) {
            call_user_func_array($handler, $matches);
        }
        break;
    }
}

if (!$routeFound) {
    http_response_code(404);
    view('404');
}
