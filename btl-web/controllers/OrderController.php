<?php
require_once 'models/OrderModel.php';
class OrderController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new OrderModel($db);

    }
    public function getUserOrders($user_id)
    {
        $orders_data = $this->model->getOrdersByUserId($user_id);
        $orders = [];
        foreach ($orders_data as $item) {
            array_push($orders, $item);
        }
        include 'views/order_view.php';
    }

    public function createOrder($user_id, $product_id, $qty, $trx_id, $p_status)
    {
        $this->model->createOrder($user_id, $product_id, $qty, $trx_id, $p_status);
    }
}

?>