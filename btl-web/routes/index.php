<?php
$request = $_SERVER['REQUEST_URI'];
$request = parse_url($request, PHP_URL_PATH);
require_once 'config/db_connect.php';
$parts = explode('/', $request);

    switch ($parts[1]) {
        case '':
            require(ROOT_PATH . '/controllers/HomeController.php');
            $controller = new HomeController();
            $controller->index();
            break;
        case 'about_us':
            require(ROOT_PATH . '/controllers/AboutUsController.php');
            $controller = new AboutUsController();
            $controller->index();
            break;
        case 'product': 
            require('Product.php');
            break;
        case 'view_category':
            require(ROOT_PATH . '/controllers/StoreController.php');
            $controller = new StoreController($conn);
            break;
        case 'news': 
            require(ROOT_PATH . '/controllers/HomeController.php');
            $controller = new HomeController();
            $controller->news();
            break;
        case 'contact_us':
            require(ROOT_PATH . '/controllers/HomeController.php');
            $controller = new HomeController();
            $controller->contact_us(); 
            break;
        case 'view_brand':
            break;
        case 'admin':
            include_once("admin.php");
            break;
        default:
            http_response_code(404);
            echo "404 Not Found";
            break;
    }

// if ($_GET['action'] == 'listProducts') {
//     $db = $conn;
//     $productModel = new ProductModel($db);
//     $productController = new ProductController($productModel);
//     $products = $productController->listProducts();
//     include 'views/product_list_view.php';
// }

?>