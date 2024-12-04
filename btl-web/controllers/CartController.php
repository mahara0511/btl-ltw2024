<?php

// $ip_add = $_SERVER['REMOTE_ADDR'];
// $uid = $_SESSION['uid'] ?? null;

class CartController
{
    private $model;

    public function __construct($db)
    {
        require_once(ROOT_PATH . '/models/CartModel.php');
        $this->model = new CartModel($db);
    }

    // Render the main cart view
    public function view_cart($ip_add, $uid = null)
    {
        $cart_items = $this->model->getUserCartData($ip_add, $uid);
        $total_price = 0;
        foreach ($cart_items as $item) {
            $total_price += $item['qty'] * $item['product_price'];
        }
        $data = ['cart_items' => $cart_items, 'total_price' => $total_price];
        $this->render('views/cart.php', $data);
    }

    // Render the cart dropdown (e.g., popup)
    public function view_cart_dropdown($ip_add, $uid = null)
    {
        $cart_items = $this->model->getUserCartData($ip_add, $uid);
        $total_price = 0;
        foreach ($cart_items as $item) {
            $total_price += $item['qty'] * $item['product_price'];
        }
        $data = ['cart_items' => $cart_items, 'total_price' => $total_price];
        return $data;
        // $this->render('views/layouts/cart_popup.php', $data);
    }

    // Handle cart actions (e.g., add, remove, update)
    public function takeCartAction($actionCart, $pid, $qty, $ip_add, $uid = null)
    {
        // Validate inputs
        $pid = intval($pid);
        $qty = intval($qty);

        $response = [
            'status' => 'warning',
            'message' => 'Invalid action or parameters.',
        ];

        switch ($actionCart) {
            case "addToCart":
                $response = $this->model->addToCart($pid, $qty, $ip_add, $uid);
                break;
            case "countUserCart":
                $count = $this->model->countUserCart($ip_add, $uid);
                $response = [
                    'status' => 'success',
                    'message' => "Counting user cart was successfully!",
                    'count' => $count,
                ];
                break;
            case "removeItemfromCart":
                $response = $this->model->removeItemfromCart($pid, $ip_add, $uid);
                break;
            case "updateItemfromCart":
                $response = $this->model->updateItemfromCart($pid, $qty, $ip_add, $uid);
                break;
            default:
                $response = [
                    'status' => 'error',
                    'message' => 'ERROR: Cannot find this type of action!',
                ];
        }

        return $response;
    }

    // Helper function to render a view
    private function render($view, $data = [])
    {
        extract($data); // Extract array keys as variables
        if (file_exists($view)) {
            include $view;
        } else {
            echo "View not found: $view";
        }
    }

    public function handleAjaxRequest()
    {
        $action = $_POST['cart_action'] ?? '';
        $pid = $_POST['pid'] ?? 0;
        $qty = $_POST['qty'] ?? 1;
        $ip_add = $_SERVER['REMOTE_ADDR'];
        $uid = $_SESSION['uid'] ?? null;

        $response = [
            'status' => 'error',
            'message' => 'Invalid request.'
        ];

        switch ($action) {
            case 'updateItemfromCart':
                $response = $this->takeCartAction($action, $pid, $qty, $ip_add, $uid);
                break;
            case 'removeItemfromCart':
                $response = $this->takeCartAction($action, $pid, 0, $ip_add, $uid);
                break;
            case 'addToCart':
                $response = $this->takeCartAction($action, $pid, $qty, $ip_add, $uid);
                break;
            default:
                $response['message'] = 'Unknown action.';
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
