<?php
    class HomeController {

    private $model;

    public function __construct()
    {
        require_once(ROOT_PATH . "\models\HomeModel.php");
        $this->model = new HomeModel();
    }
        public function index() {
            $products1 = $this->model->getProduct(70, 75);
            $products2 = $this->model->getProduct(59, 65);
            require(ROOT_PATH.'/views/pages/homePageView/index.php');
        }

        public function contact_us() {
            require(ROOT_PATH.'/views/contact.php');
        }

        public function news() {
            require(ROOT_PATH.'/views/news.php');
        }
    }

?>
