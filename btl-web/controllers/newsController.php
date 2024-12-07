<?php
class NewsController {
    private $model;

    public function __construct()
    {
        require_once 'models/NewsModel.php';
        $this->model = new NewsModel();
    }

    public function index($N)
    {
        # Limit 12 articles per page
        $npage = ceil($this->model->len() / 12);
        $start = max(0, ($N - 1) * 12);
        $end = min($N * 12, $this->model->len());
        $curpage = ceil($end / 12);
        $news = $this->model->getNewsData($start, $end - $start);
        include 'views/news.php';
    }
}
?>