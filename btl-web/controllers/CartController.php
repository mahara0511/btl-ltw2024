<?php
class CartController
{
    private $model;

    public function __construct($db)
    {
        require_once(ROOT_PATH . '/models/CartModel.php');
        $this->model = new CartModel($db);
    }

    // Render the main cart view
    public function view_cart($uid = null)
    {
        if (!$uid) {
            $this->redirectToLogin();
            return;
        }

        $cart_items = $this->model->getUserCartData($uid);
        $total_price = $this->calculateTotalPrice($cart_items);

        $data = [
            'cart_items' => $cart_items,
            'total_price' => $total_price
        ];
        $this->render('views/cart.php', $data);
    }

    // Render the cart dropdown (e.g., popup)
    public function view_cart_dropdown($uid = null)
    {
        if (!$uid) {
            return [];
        }

        $cart_items = $this->model->getUserCartData($uid);
        $total_price = $this->calculateTotalPrice($cart_items);

        return [
            'cart_items' => $cart_items,
            'total_price' => $total_price
        ];
    }

    // Handle cart actions (e.g., add, remove, update)
    public function takeCartAction($actionCart, $pid, $qty, $uid = null)
    {
        // Validate inputs
        $pid = intval($pid);
        $qty = intval($qty);

        if (!$uid) {
            return [
                'status' => 'warning',
                'message' => 'User not logged in. Please log in to modify your cart.'
            ];
        }

        $response = [
            'status' => 'warning',
            'message' => 'Invalid action or parameters.',
        ];

        switch ($actionCart) {
            case "addToCart":
                $response = $this->model->addToCart($pid, $qty, $uid);
                break;
            case "countUserCart":
                $count = $this->model->countUserCart($uid);
                $response = [
                    'status' => 'success',
                    'message' => "Cart item count retrieved successfully!",
                    'count' => $count,
                ];
                break;
            case "removeItemfromCart":
                $response = $this->model->removeItemfromCart($pid, $uid);
                break;
            case "updateItemfromCart":
                $response = $this->model->updateItemfromCart($pid, $qty, $uid);
                break;
            default:
                $response = [
                    'status' => 'error',
                    'message' => 'Unknown action.',
                ];
        }

        return $response;
    }


    // Helper function to calculate total price
    private function calculateTotalPrice($cart_items)
    {
        $total_price = 0;

        if (isset($cart_items)) {
            foreach ($cart_items as $item) {
                $total_price += $item['qty'] * $item['product_price'];
            }
        }

        return $total_price;
    }

    // Redirect to login page if the user is not logged in
    private function redirectToLogin()
    {
        header("Location: /login");
        exit();
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
        $uid = $_SESSION['uid'] ?? null;

        $response = [
            'status' => 'error',
            'message' => 'Invalid request.'
        ];

        switch ($action) {
            case 'updateItemfromCart':
                $response = $this->takeCartAction($action, $pid, $qty, $uid);
                break;
            case 'removeItemfromCart':
                $response = $this->takeCartAction($action, $pid, 0, $uid);
                break;
            case 'addToCart':
                $response = $this->takeCartAction($action, $pid, $qty, $uid);
                break;
            default:
                $response['message'] = 'Unknown action.';
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
