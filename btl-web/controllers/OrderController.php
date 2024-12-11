<?php
require_once 'models/OrderModel.php';
class OrderController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new OrderModel($db);

    }
    /**
     * Retrieve all orders for a specific user.
     * 
     * @param int $user_id - The ID of the user.
     * @return void
     */
    public function getUserOrders($user_id)
    {
        $orders_data = $this->model->getOrdersByUserId($user_id);
        $orders = [];
        foreach ($orders_data as $item) {
            array_push($orders, $item);
        }
        require_once 'views/order.php';
    }

    /**
     * Create a new order.
     * 
     * @param array $orderData - Data for the new order.
     * @param array $products - List of products to be added to the order.
     * @return array
     */
    public function createOrder($orderData, $products)
    {
        $orderId = $this->model->createOrder($orderData);
        if ($orderId >= 0) {
            if ($this->model->addOrderProducts($orderId, $products)) {
                return ['success' => true, 'message' => 'Place order successfully!'];
            }
        }
        return ['success' => false, 'message' => 'Cannot create order. Please try again!'];

    }

    /**
     * Update an existing order.
     * 
     * @param int $orderId - The ID of the order to update.
     * @param array $orderData - Updated data for the order.
     * @return void
     */
    public function updateOrder($orderId, $orderData)
    {
        $this->model->updateOrder($orderId, $orderData);
    }

    /**
     * Delete an order and its associated products.
     * 
     * @param int $orderId - The ID of the order to delete.
     * @return void
     */
    public function deleteOrder($orderId)
    {
        $this->model->deleteOrder($orderId);
    }

    /**
     * Get details for a specific order.
     * 
     * @param int $orderId - The ID of the order.
     * @return array|false - The order details or false if not found.
     */
    public function getOrderDetails($orderId)
    {
        $order = $this->model->getOrderById($orderId);
        if ($order) {
            $order['products'] = $this->model->getOrderProducts($orderId);
        }
        return $order;
    }

    public function showCheckoutForm()
    {
        // Extract product IDs and quantities from $_POST
        $showOrderData = [];
        if (isset($_POST['checkout']) && $_POST['checkout'] == 'Checkout') {

            $products = $_POST['products'] ?? [];

            // Prepare the cart items to pass to the view
            $order_items = [];
            foreach ($products as $item) {
                $clean_price = (float) str_replace('$', '', $item['price']);
                $order_items[] = [
                    'product_id' => $item['product_id'],
                    'qty' => (int) $item['qty'],
                    'price' => (int) $clean_price
                ];
            }

            // Calculate the total price
            $total_price = 0;
            foreach ($order_items as $item) {
                $item['subtotal'] = round($item['price'] * $item['qty']);
                $total_price += $item['subtotal'];
            }

            $user_data = $_SESSION['uid'] ? $this->model->getUserbyId(intval($_SESSION['uid'])) : [];

            // Pass data to the view
            $showOrderData = [
                'user_data' => $user_data,
                'order_items' => $order_items,
                'total_price' => round($total_price, 0)
            ];

            // echo json_encode($showOrderData);

            require_once 'views/checkout_form.php';
        }
    }

    public function placeOrder()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $products = $input['products'];
        $orderData = [
            'user_id' => $_SESSION['uid'],
            'f_name' => $input['f_name'],
            'email' => $input['email'],
            'address' => $input['address'],
            'district' => $input['district'],
            'province' => $input['province'],
            'cardname' => $input['cardname'],
            'cardnumber' => $input['cardnumber'],
            'prod_count' => count($products),
            'total_amt' => $input['total_amt'],
        ];

        $response = $this->createOrder($orderData, $products);
        echo json_encode($response);
    }
}
?>