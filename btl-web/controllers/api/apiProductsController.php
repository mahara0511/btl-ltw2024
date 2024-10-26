<?php 

class ApiProductsController {

    public function getAllProducts() {
        require_once(ROOT_PATH. '/models/ProductModel.php');
    
        $productModel = new Product();
        $products = $productModel->getAllProducts();
        header('Content-Type: application/json');
        echo json_encode($products);
    }

    public function add() {
        require_once(ROOT_PATH.'/models/ProductModel.php');
        $productModel = new Product();
        $response = $productModel->add();
        header('Content-Type: application/json');
        echo json_encode($response);
    }


    public function get() {
        require_once(ROOT_PATH. '/models/ProductModel.php');
    
        $productModel = new Product();
        $product = $productModel->get();
        header('Content-Type: application/json');
        echo json_encode($product);
    }
    public function edit() {
        require_once(ROOT_PATH.'/models/ProductModel.php');
        $productModel = new Product();
        $response = $productModel->edit();
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}

?>