<?php
define('ROOT_PATH', __DIR__);
require_once("routes/index.php");
?>


<?php
require_once 'config/db_connect.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/StoreController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/CartController.php';
require_once 'controllers/OrderController.php';



// Example usage

// $categoryController = new AdminController($conn);
// $categoryController->getAdmin(1);
// echo '<br>';

$storeController = new StoreController($conn);
$productController = new ProductController($conn);
$cartController = new CartController($conn);


// Handle actions
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action === 'view_category' && is_numeric($_GET['cid'])) {
        $storeController->view_category($_GET['cid']);
    } elseif ($action === 'view_brand' && is_numeric($_GET['bid'])) {
        $storeController->view_brand($_GET['bid']);
    } elseif ($action === 'view_brand') {
        $storeController->view();
    } elseif ($action == 'view_cart') {
        $cartController->view_cart($_SERVER['REMOTE_ADDR'], $_SESSION['uid'] ?? null);
        if (isset($_GET['type'])) {
            $typeOfCartAction = $_GET['type'] ?? null;
            $pid = $_GET['pid'] ?? 0;
            $qty = $_GET['qty'] ?? 1;
            $ip_add = $_SERVER['REMOTE_ADDR'];
            $uid = $_SESSION['uid'] ?? null;
            $respone = $cartController->takeCartAction($typeOfCartAction, $pid, $qty, $ip_add, $uid);
        }
    }
} elseif (isset($_GET['product_id'])) {
    if (is_numeric($_GET['product_id'])) {
        $product_id = intval($_GET['product_id']);
        $productController->view_product_detail($product_id);
    } else {
        echo "ERROR: Product not found or invalid request.";
    }
} else {
    echo "ERROR: .....................................";
}








// echo '<br>';

// $orderController = new Ordercontroller($conn);
// $orderController->getUserOrders(12);
// echo '<br>';

// $orderController->getUserOrders(14);
// echo '<br>';
?>

<?php
// include "views/layouts/cart_popup.php";
?>