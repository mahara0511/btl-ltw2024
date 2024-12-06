<?php
class NewsController {
    private $model;

    public function __construct()
    {
        require_once 'models/newsModel.php';
        $this->model = new newsModel();
    }

    public function index()
    {
        $news = $this->model->getNewsData(12);
        include 'views/news.php';
    }
}
?>