<?php
class OrderModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getOrdersByUserId($user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createOrder($user_id, $product_id, $qty, $trx_id, $p_status)
    {
        $query = $this->db->prepare("INSERT INTO orders (user_id, product_id, qty, trx_id, p_status) VALUES (?, ?, ?, ?, ?)");
        $query->execute([$user_id, $product_id, $qty, $trx_id, $p_status]);
    }

    public function getNumberOfOrders() {
        $query = "SELECT order_id FROM orders_info"; 
        $result = mysqli_query($this->db, $query); 
        return mysqli_num_rows($result); 
    }
}
?>