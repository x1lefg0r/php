<?php

namespace src\Controllers;
use Exceptions\NotFoundException;
use src\View\View;
use src\Models\Articles\Article;
use src\Models\Users\User;
use src\Models\Comments\Comment;


class ArticleController {
    private $view;
    public function __construct()
    {
        $this->view = new View(dirname(dirname(__DIR__)).'/templates');
        // $this->db = new Db();
    }

    public function index(){
        $articles = Article::findAll();
        $this->view->renderHtml('main/main', ['articles'=>$articles]);
    }

    public function create(){
        return $this->view->renderHtml('article/create');
    }

    public function store()
    {
        $article = new Article();
        $article->setName($_POST['name']);
        $article->setText($_POST['text']);
        $article->setAuthorId((int) $_POST['author_id']);
        $article->save();
    
        header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/');
        exit;
    }
    
    public function show(int $id)
    {
        // Получаем статью
        $article = Article::getById($id);
    
        if ($article == null) {
            throw new NotFoundException();
        }
    
        // Получаем ID автора статьи
        $authorId = $article->getAuthorId();
    
        // Получаем объект пользователя (автора) по его ID
        $author = User::getById($authorId);
    
        // Получаем комментарии для статьи
        $comments = Comment::findByArticleId($id);
    
        // Передаем статью, автора и комментарии в шаблон
        $this->view->renderHtml('article/show', [
            'article' => $article,
            'author' => $author,  // Передаем объект $author, а не только $authorId
            'comments' => $comments
        ]);
    }

    public function edit(int $id){
        $article = Article::getById($id);
        if ($article == null){
            throw new NotFoundException();
        }
        return $this->view->renderHtml('/article/edit', ['article'=>$article]);
    }

    public function update(int $id){
        $article = Article::getById($id);
        if ($article == null){
            throw new NotFoundException();
        }
    
        $article->setName($_POST['name']);
        $article->setText($_POST['text']);
        $article->save();
    
        $author = $article->getAuthor();
        $comments = Comment::findByArticleId($article->getId());
    
        return $this->view->renderHtml('article/show', [
            'article' => $article,
            'author' => $author,
            'comments' => $comments
        ]);                
    }
    
    public function delete(int $id){
        $article = Article::getById($id);
        if ($article == null){
            throw new NotFoundException();
        }
        $article->delete();
        return header('Location:http://localhost/php/project/www/index.php');
    }
}