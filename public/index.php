<?php

declare(strict_types=1);

use App\Http\Controllers\MahasiswaController;

define('BASE_PATH', dirname(__DIR__));
session_start();

spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    if (str_starts_with($class, $prefix)) {
        $file = BASE_PATH . '/app/' . str_replace('\\', '/', substr($class, strlen($prefix))) . '.php';
        if (is_file($file)) require $file;
    }
});

$database = BASE_PATH . '/database/database.sqlite';
if (!is_file($database)) {
    $db = new PDO('sqlite:' . $database);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec(file_get_contents(BASE_PATH . '/database/schema.sql'));
} else {
    $db = new PDO('sqlite:' . $database);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

function view(string $name, array $data = []): void
{
    extract($data);
    require BASE_PATH . '/resources/views/' . str_replace('.', '/', $name) . '.php';
}

function redirect(string $path, string $message = ''): never
{
    if ($message !== '') $_SESSION['message'] = $message;
    header('Location: ' . $path);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';
$routes = require BASE_PATH . '/routes/web.php';
$controller = new MahasiswaController($db);

foreach ($routes as [$routeMethod, $route, $handler]) {
    $pattern = '#^' . preg_replace('#\{[^/]+\}#', '([^/]+)', $route) . '/?$#';
    if ($method === $routeMethod && preg_match($pattern, $path, $matches)) {
        array_shift($matches);
        [$class, $action] = $handler;
        $controller->$action(...array_map('intval', $matches));
        exit;
    }
}

http_response_code(404);
view('errors.404');
