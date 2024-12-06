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
    case 'view_cart':
        require(ROOT_PATH . '/controllers/CartController.php');
        $cartController = new CartController($conn);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cartController->handleAjaxRequest();
            exit;
        }
        $cartController->view_cart($_SERVER['REMOTE_ADDR'], $_SESSION['uid'] ?? null);
        // $controller->v();
        break;
    case 'store':
        require(ROOT_PATH . '/controllers/StoreController.php');
        $controller = new StoreController($conn);

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['product_id'])) {
                if (is_numeric($_GET['product_id'])) {
                    require(ROOT_PATH . '/controllers/ProductController.php');
                    $productController = new ProductController($conn);

                    $product_id = intval($_GET['product_id']);
                    $productController->view_product_detail($product_id);
                }
            } else {
                $action = $_GET['action'] ?? 'view';
                switch ($action) {
                    case 'view_category':
                        if (isset($_GET['cid']) && is_numeric($_GET['cid'])) {
                            $controller->view_category($_GET['cid']);
                        } else {
                            echo "ERROR: Invalid category ID.";
                        }
                        break;

                    case 'view_brand':
                        if (isset($_GET['bid']) && is_numeric($_GET['bid'])) {
                            $controller->view_brand($_GET['bid']);
                        } else {
                            echo "ERROR: Invalid brand ID.";
                        }
                        break;

                    case 'view':
                        $controller->view();
                        break;
                }
            }
        }
        break;
    case 'product':
        require('Product.php');
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