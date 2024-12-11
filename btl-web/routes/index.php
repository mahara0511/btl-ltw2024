<?php
$request = $_SERVER['REQUEST_URI'];
$request = parse_url($request, PHP_URL_PATH);
require_once 'config/db_connect.php';

$parts = explode('/', $request);
if ($parts[1] !== "news") {
    setcookie("curpage", -1, strtotime("2000-01-01 00:00:00"), "/");
}
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
    case 'news':
        require(ROOT_PATH . '/controllers/NewsController.php');
        $controller = new NewsController();

        if (!isset($_COOKIE["curpage"])) {
            $controller->index(1);
        } else {
            $controller->index($_COOKIE["curpage"]);
        }
        break;
    case 'view_cart':
        require(ROOT_PATH . '/controllers/CartController.php');
        $cartController = new CartController($conn);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cartController->handleAjaxRequest();
            exit;
        }
        $cartController->view_cart($_SESSION['uid'] ?? null);
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
            } else if (isset($_GET['cart_pid'])) {
                if (is_numeric($_GET['cart_pid'])) {
                    require(ROOT_PATH . '/controllers/ProductController.php');
                    $productController = new ProductController($conn);
                    $product_id = intval($_GET['cart_pid']);
                    $productController->detailForProduct($product_id);
                    exit;
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
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_GET['action'] ?? null;
            switch ($action) {
                case 'addComment':
                    require(ROOT_PATH . '/controllers/ProductController.php');
                    $productController = new ProductController($conn);
                    $productController->addNewComment();
                    exit;
                case 'editComment':
                    require(ROOT_PATH . '/controllers/ProductController.php');
                    $productController = new ProductController($conn);
                    $productController->updateComment();
                    exit;
                case 'deleteComment':
                    require(ROOT_PATH . '/controllers/ProductController.php');
                    $productController = new ProductController($conn);
                    $productController->deleteComment();
                    exit;
                default:
                    echo var_dump($_POST); // Debugging fallback
                    exit;
            }
        }
        break;
    case 'product':
        require('Product.php');
        break;
    case 'contact_us':
        require(ROOT_PATH . '/controllers/HomeController.php');
        $controller = new HomeController();
        $controller->contact_us();
        break;
    case 'view_brand':
        break;
    case 'admin':
        include_once("admin/index.php");
        break;
    case 'subcribe': 
        require(ROOT_PATH . '/controllers/HomeController.php');
        $controller = new HomeController();
        $controller->postEmail();
    case 'login':
        if (isset($_COOKIE["uid"])||isset($_SESSION["uid"])){
            header('Location: /');
            echo '<script>console.log("You are already logged in");</script>';
        }
        else {
            echo '<script>console.log("You are not logged in");</script>';
        }
        $sender='';
        if (isset($_SERVER['HTTP_REFERER']))$sender=$_SERVER['HTTP_REFERER'];
        setcookie('returnPage',$sender,strtotime("+1 day"),"/","","",TRUE);
        require(ROOT_PATH . '/controllers/userInfoController.php');
        $controller=new userInfoController($conn);
        $controller->login_form();
        break;
    case 'register':
        if (isset($_COOKIE["uid"])||isset($_SESSION["uid"])){
            header('Location: /');
            echo '<script>console.log("You are already logged in");</script>';
        }
        else {
            echo '<script>console.log("You are not logged in");</script>';
        }
        $sender='';
        if (isset($_SERVER['HTTP_REFERER']))$sender=$_SERVER['HTTP_REFERER'];
        setcookie('returnPage',$sender,strtotime("+1 day"),"/","","",TRUE);
        require(ROOT_PATH . '/controllers/userInfoController.php');
        $controller=new userInfoController($conn);
        $controller->register_form();
        break;
    case 'user_info':
        if(!isset ($_SESSION['uid'])&& !isset ($_COOKIE['uid'])) header('Location: /');
        if (!isset ($_SESSION['uid'])) $_SESSION['uid']=$_SESSION['uid'];
        require(ROOT_PATH . '/controllers/userInfoController.php');
        $controller=new userInfoController($conn);
        $controller->showInfo();
        break;
    case 'password':
        if(!isset ($_SESSION['uid'])&& !isset ($_COOKIE['uid'])) header('Location: /');
        if (!isset ($_SESSION['uid'])) $_SESSION['uid']=$_SESSION['uid'];
        require(ROOT_PATH . '/controllers/userInfoController.php');
        $controller=new userInfoController($conn);
        $controller->passManagement();
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
