<!-- <?php
// define('ROOT_PATH', __DIR__);
// require_once("routes/index.php");
?> -->


<?php
require_once 'config/db_connect.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/StoreController.php';
require_once 'controllers/OrderController.php';



// Example usage

// $categoryController = new AdminController($conn);
// $categoryController->getAdmin(1);
// echo '<br>';

$storeController = new StoreController($conn);
// Handle actions
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action === 'view_category' && isset($_GET['cid'])) {
        $storeController->view_category($_GET['cid']);
    } elseif ($action === 'view_brand' && isset($_GET['bid'])) {
        $storeController->view_brand($_GET['bid']);
    } else {
        $storeController->view();
    }
} else {
    $storeController->view();
}

// echo '<br>';

// $orderController = new Ordercontroller($conn);
// $orderController->getUserOrders(12);
// echo '<br>';

// $orderController->getUserOrders(14);
// echo '<br>';
?>