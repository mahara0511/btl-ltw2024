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
$categoryController = new AdminController($conn);
$categoryController->getAdmin(1);
echo '<br>';

$productController = new ProductController($conn);
$productController->view();
echo '<br>';

$orderController = new Ordercontroller($conn);
$orderController->getUserOrders(12);
echo '<br>';

$orderController->getUserOrders(14);
echo '<br>';
?>