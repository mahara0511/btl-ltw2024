<?php
require_once 'models/StoreModel.php';
class ProductController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new ProductModel($db);

    }

    public function view()
    {
        $products_data = $this->model->getAllProducts();
        $products = [];
        foreach ($products_data as $item) {
            array_push($products, $item);
        }

        $top_products_data = $this->model->getTopProducts();
        $top_products = [];
        foreach ($top_products_data as $item) {
            array_push($top_products, $item);
        }

        $brands = $this->model->getBrands();
        $categories = $this->model->getCategories();
        include 'views/store.php';
    }

    public function viewProduct($product_id)
    {
        return $this->model->getProductById($product_id);
    }
}

?>