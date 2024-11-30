<?php
require_once 'models/CartModel.php';

class CartController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new CartModel($db);
    }

    // Render the main cart view
    public function view_cart($ip_add, $uid = null)
    {
        $cart_items = $this->model->getUserCartData($ip_add, $uid);
        $data = ['cart_items' => $cart_items];
        $this->render('views/cart.php', $data);
    }

    // Render the cart dropdown (e.g., popup)
    public function view_cart_dropdown($ip_add, $uid = null)
    {
        $cart_items = $this->model->getUserCartData($ip_add, $uid);
        $data = ['cart_items' => $cart_items];
        $this->render('views/layouts/cart_popup.php', $data);
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
                $response['message'] = "ERROR: Cannot find this type of action!";
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
}
