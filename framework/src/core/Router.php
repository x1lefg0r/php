<?php
namespace src\core;

class Router
{
    protected $controller = 'HomeController';
    protected $action = 'index';
    protected $params = [];

    public function dispatch($url)
    {
        error_log("Dispatching URL: $url");
        $url = $this->parseUrl($url);
        error_log("Parsed URL: " . print_r($url, true));

        if (isset($url[0]) && !empty($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            $controllerFile = BASE_PATH . '/src/controllers/' . $controllerName . '.php';
            if (file_exists($controllerFile)) {
                $this->controller = $controllerName;
                unset($url[0]);
            } else {
                error_log("Controller file not found: $controllerFile");
                $this->handleNotFound();
                return;
            }
        }

        $controllerClass = 'src\\controllers\\' . $this->controller;
        if (!class_exists($controllerClass)) {
            error_log("Controller class not found: $controllerClass");
            $this->handleNotFound();
            return;
        }
        $controller = new $controllerClass();

        if (isset($url[1]) && !empty($url[1])) {
            if (method_exists($controller, $url[1])) {
                $this->action = $url[1];
                unset($url[1]);
            } else {
                error_log("Method not found: {$url[1]} in $controllerClass");
                $this->handleNotFound();
                return;
            }
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$controller, $this->action], $this->params);
    }

    protected function parseUrl($url)
    {
        if ($url !== '') {
            $url = filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL);
            $url = preg_replace('/[^a-zA-Z0-9\/\-]/', '', $url);
            return explode('/', $url);
        }
        return [];
    }

    protected function handleNotFound()
    {
        error_log("404 Not Found");
        http_response_code(404);
        include BASE_PATH . '/src/views/error/404.php';
        exit;
    }
}