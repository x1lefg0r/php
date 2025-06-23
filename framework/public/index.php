<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class) . '.php';
    $file = __DIR__ . '/../' . $path;
    if (file_exists($file)) {
        require_once $file;
    } else {
        error_log("Class file not found: $file");
        throw new \Exception("Class {$class} not found");
    }
});

define('BASE_PATH', dirname(__DIR__));
define('BASE_URL', '/framework/public');

try {
    require_once BASE_PATH . '/src/core/Router.php';
    $url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';
    $router = new src\core\Router();
    $router->dispatch($url);
} catch (\Exception $e) {
    error_log("Error: " . $e->getMessage());
    http_response_code(500);
    include BASE_PATH . '/src/views/error/500.php';
    exit;
}