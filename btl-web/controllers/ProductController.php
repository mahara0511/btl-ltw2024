<?php
require_once 'models/ProductModel.php';

class ProductController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new ProductModel($db);
    }
    public function view_product_detail($product_id)
    {
        $product_detail = $this->model->getProductById($product_id);
        $product_detail['sale'] = rand(0, 75);
        $related_products = $this->getRelatedProducts($product_id, $product_detail['cat_id']);
        require_once 'views/product.php';
    }
    public function getRelatedProducts($product_id, $cat_id)
    {
        return $this->model->getRelatedProductsByCategory($product_id, $cat_id);
    }
}
