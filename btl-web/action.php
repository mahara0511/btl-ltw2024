<?php
session_start();
require_once 'config/db_connect.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/StoreController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/CartController.php';
require_once 'controllers/OrderController.php';
?>


<?php
// Determine the action

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    switch ($requestUri) {
        case '/cart-actions':
            require_once 'controllers/CartController.php';
            $cartController->handleAjaxRequest();
            exit;
        default:
            exit;

    }

    // // Handle POST requests (e.g., cart actions via AJAX)
    // $typeOfCartAction = $_POST['cart_action'] ?? '';
    // $pid = $_POST['pid'] ?? 0;
    // $qty = $_POST['qty'] ?? 1;
    // $ip_add = $_SERVER['REMOTE_ADDR'];
    // $uid = $_SESSION['uid'] ?? null;
    // $response = [
    //     'status' => 'error',
    //     'message' => 'Invalid request.'
    // ];
    // // Process cart actions
    // if ($typeOfCartAction) {
    //     $response = $cartController->takeCartAction($typeOfCartAction, intval($pid), intval($qty), $ip_add, $uid);
    //     header('Content-Type: application/json');
    //     echo json_encode($response);
    // } else {
    //     header('Content-Type: application/json');
    //     echo json_encode(['status' => 'error', 'message' => 'Invalid cart action.']);
    // }
}