<?php
// $request = $_SERVER['REQUEST_URI'];
// $request = parse_url($request, PHP_URL_PATH);

// $parts = explode('/', $request);

//     switch ($parts[1]) {
//         case '':
//             require(ROOT_PATH . '/controllers/HomeController.php');
//             $controller = new HomeController();
//             $controller->index();
//             break;
//         case 'product': 
//             require('Product.php');
//             break;
//         case 'api': 
//             require('api/index.php');
//             break;
//         default:
//             http_response_code(404);
//             echo "404 Not Found";
//             break;
//     }

if ($_GET['action'] == 'listProducts') {
    $db = $conn;
    $productModel = new ProductModel($db);
    $productController = new ProductController($productModel);
    $products = $productController->listProducts();
    include 'views/product_list_view.php';
}

?>