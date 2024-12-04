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

?>

<?php
// include "views/layouts/cart_popup.php";
?>