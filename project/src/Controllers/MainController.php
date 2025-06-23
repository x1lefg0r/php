<?php

namespace src\Controllers;
use src\View\View;
use src\Services\Db;

class MainController{
    private $view;
    private $db;

    public function __construct()
    {
        $this->view = new View(dirname(dirname(__DIR__)).'/templates');
        $this->db = new Db();
    }
    
    public function sayHello(string $name){
        $this->view->renderHtml('main/hello', ['name'=>$name, 'title' => 'Страница приветствия']);
    }


    public function sayBye(string $name){
        $data = ['name' => $name, 'title' => 'До свидания!'];
        $this->view->renderHtml('main/bye', $data);
    }
}