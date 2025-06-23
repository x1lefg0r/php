<?php
namespace src\core;

class Controller
{
    /**
     * Загружает и возвращает экземпляр модели.
     */
    protected function model($model)
    {
        $modelClass = 'src\\models\\' . $model;
        
        if (class_exists($modelClass)) {
            return new $modelClass();
        }
        
        throw new \Exception("Model {$model} not found");
    }

    /**
     * Загружает представление с переданными данными.
     * @param string $view Путь к представлению
     * @param array $data Ассоциативный массив данных для передачи в представление
     */
    protected function view($view, $data = [])
{
    extract($data);
    $viewFile = BASE_PATH . '/src/views/' . $view . '.php';
    error_log("Trying to load view: $viewFile");
    if (file_exists($viewFile)) {
        require_once $viewFile;
    } else {
        error_log("View not found: $viewFile");
        throw new \Exception("View {$view} not found");
    }
}
} 