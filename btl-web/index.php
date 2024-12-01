<!-- <?php
// define('ROOT_PATH', __DIR__);
// require_once("routes/index.php");
?> -->

<?php require_once 'views/layouts/header.php'; ?>

<?php
require_once 'config/db_connect.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/StoreController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/CartController.php';
// require_once 'controllers/OrderController.php';



// Example usage

// $categoryController = new AdminController($conn);
// $categoryController->getAdmin(1);
// echo '<br>';

$storeController = new StoreController($conn);
$productController = new ProductController($conn);
$cartController = new CartController($conn);
// $cartController->view_cart_dropdown($_SERVER['REMOTE_ADDR'], $_SESSION['uid'] ?? null);
?>

<?php
// Determine the action
$action = $_GET['action'] ?? null;
// Routing logic
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Handle GET requests
    if (isset($_GET['product_id'])) {
        if (is_numeric($_GET['product_id'])) {
            $product_id = intval($_GET['product_id']);
            $productController->view_product_detail($product_id);
        }
    } else {
        switch ($action) {
            case 'view_category':
                if (isset($_GET['cid']) && is_numeric($_GET['cid'])) {
                    $storeController->view_category($_GET['cid']);
                } else {
                    echo "ERROR: Invalid category ID.";
                }
                break;

            case 'view_brand':
                if (isset($_GET['bid']) && is_numeric($_GET['bid'])) {
                    $storeController->view_brand($_GET['bid']);
                } else {
                    echo "ERROR: Invalid brand ID.";
                }
                break;

            case 'view':
                $storeController->view();
                break;

            case 'view_cart':
                $cartController->view_cart($_SERVER['REMOTE_ADDR'], $_SESSION['uid'] ?? null);
                break;

            case 'product_detail':
                if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) {
                    $productController->view_product_detail(intval($_GET['product_id']));
                } else {
                    echo "ERROR: Product not found or invalid request.";
                }
                break;

            default:
                echo "ERROR: Action not found.";
                break;
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle POST requests (e.g., cart actions via AJAX)
    $typeOfCartAction = $_POST['cart_action'] ?? '';
    echo $typeOfCartAction;
    $pid = $_POST['pid'] ?? 0;
    $qty = $_POST['qty'] ?? 1;
    $ip_add = $_SERVER['REMOTE_ADDR'];
    $uid = $_SESSION['uid'] ?? null;
    $response = [
        'status' => 'error',
        'message' => 'Invalid request.'
    ];
    // Process cart actions
    if ($typeOfCartAction) {
        $response = $cartController->takeCartAction($typeOfCartAction, intval($pid), intval($qty), $ip_add, $uid);
        echo json_encode($response);
        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid cart action.']);
        exit;
    }
} else {
    echo "ERROR: Invalid request method.";
}


// }




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