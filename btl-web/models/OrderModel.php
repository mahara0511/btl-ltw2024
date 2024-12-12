<?php

class OrderModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Create a new order in the orders_info table.
     * 
     * @param array $orderData - Data for the new order.
     * @return int - The ID of the newly created order or false on failure.
     */
    public function createOrder($orderData)
    {
        $sql = "INSERT INTO orders_info (user_id, order_date, f_name, email, address, district, province, cardname, cardnumber, prod_count, total_amt) 
        VALUES (?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare the SQL statement
        $stmt = $this->db->prepare($sql);

        // Bind the parameters
        $stmt->bind_param(
            'isssssssii',
            $orderData['user_id'], // user_id (integer)
            $orderData['f_name'],  // f_name (string)
            $orderData['email'],   // email (string)
            $orderData['address'], // address (string)
            $orderData['district'],    // district (string)
            $orderData['province'],   // province (string)
            $orderData['cardname'],// cardname (string)
            $orderData['cardnumber'], // cardnumber (string)
            $orderData['prod_count'], // prod_count (integer)
            $orderData['total_amt'] // total_amt (float or integer)
        );


        // Execute the query and check if it's successful
        if ($stmt->execute()) {
            $_orderID = $this->db->insert_id; // Use insert_id to get the last inserted ID
            $sql = "DELETE FROM cart WHERE user_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('i', $orderData['user_id']); // Bind the user_id as an integer
            $stmt->execute();
            return $_orderID;
        }

        return -1;
    }

    /**
     * Add products to the order_products table.
     * 
     * @param int $orderId - The ID of the order.
     * @param array $products - List of products to be added.
     * @return bool - True if all products are added successfully, otherwise false.
     */
    public function addOrderProducts($orderId, $products)
    {
        $sql = "INSERT INTO order_products (order_id, product_id, qty, amt) 
            VALUES (?, ?, ?, ?)";  // Use '?' instead of named parameters

        $stmt = $this->db->prepare($sql);

        foreach ($products as $product) {
            // Bind the parameters as positional values
            $stmt->bind_param('iiii', $orderId, $product['product_id'], $product['qty'], $product['amt']); // 'i' for integers, 'd' for decimals

            if (!$stmt->execute()) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get order details from orders_info table.
     * 
     * @param int $orderId - The ID of the order.
     * @return array|false - The order details or false if not found.
     */
    public function getOrderById($orderId)
    {
        $sql = "SELECT * FROM orders_info WHERE order_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $orderId); // 'i' for integer
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Get all products related to an order from order_products table.
     * 
     * @param int $orderId - The ID of the order.
     * @return array - List of products in the order.
     */
    public function getOrderProducts($orderId)
    {
        $sql = "SELECT * FROM order_products, products WHERE products.product_id = order_products.product_id AND order_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $orderId); // 'i' for integer
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Delete an order from orders_info and its associated products from order_products.
     * 
     * @param int $orderId - The ID of the order to delete.
     * @return bool - True if the deletion was successful, otherwise false.
     */
    public function deleteOrder($orderId)
    {
        try {
            $this->db->begin_transaction();

            $sql1 = "DELETE FROM order_products WHERE order_id = ?";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->bind_param('i', $orderId); // 'i' for integer
            $stmt1->execute();

            $sql2 = "DELETE FROM orders_info WHERE order_id = ?";
            $stmt2 = $this->db->prepare($sql2);
            $stmt2->bind_param('i', $orderId); // 'i' for integer
            $stmt2->execute();

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    /**
     * Update the order information.
     * 
     * @param int $orderId - The ID of the order to update.
     * @param array $orderData - The new order data.
     * @return bool - True if the update was successful, otherwise false.
     */
    public function updateOrder($orderId, $orderData)
    {
        $sql = "UPDATE orders_info SET 
                user_id = ?, 
                order_date = NOW(), 
                f_name = ?, 
                email = ?, 
                `address` = ?, 
                district = ?, 
                province = ?, 
                cardname = ?, 
                cardnumber = ?, 
                prod_count = ?, 
                total_amt = ? 
            WHERE order_id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(
            'isssssssiisi',
            $orderData['user_id'],  // user_id (integer)
            $orderData['f_name'],   // f_name (string)
            $orderData['email'],    // email (string)
            $orderData['address'],  // address (string)
            $orderData['district'], // district (string)
            $orderData['province'], // province (string)
            $orderData['cardname'], // cardname (string)
            $orderData['cardnumber'], // cardnumber (string)
            $orderData['prod_count'], // prod_count (integer)
            $orderData['total_amt'], // total_amt (float)
            $orderId                // order_id (integer)
        );

        return $stmt->execute();
    }


    /**
     * Get all orders for a specific user from orders_info table.
     * 
     * @param int $userId - The ID of the user.
     * @return array - List of orders for the user.
     */
    public function getOrdersByUserId($userId)
    {
        $sql = "SELECT * FROM orders_info WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $userId); // 'i' for integer
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserbyId($user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM user_info WHERE user_id = $user_id");
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function getNumberOfOrders()
    {
        $query = "SELECT order_id FROM orders_info";
        $result = mysqli_query($this->db, $query);
        return mysqli_num_rows($result);
    }
}
?>