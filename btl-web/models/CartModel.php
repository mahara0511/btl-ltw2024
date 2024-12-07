<?php
class CartModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getUserCartData($uid = null)
    {
        if (!$uid) {
            return []; // If user is not logged in, return null
        }

        $stmt = $this->db->prepare(
            "SELECT a.product_id, a.product_title, a.product_price, a.product_image, b.id, b.qty 
             FROM products a 
             JOIN cart b ON a.product_id = b.p_id 
             WHERE b.user_id = ?"
        );
        $stmt->bind_param("i", $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $cart_data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $cart_data;
    }


    public function addToCart($pid, $qty, $uid = null): array
    {
        if (!$uid) {
            return [
                'status' => 'warning',
                'message' => 'User not logged in. Please log in to save your cart.'
            ];
        }
        $stmt = $this->db->prepare("SELECT id FROM cart WHERE p_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $pid, $uid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return [
                'status' => 'warning',
                'message' => 'Product is already added into the cart!'
            ];
        } else {
            $stmt = $this->db->prepare("INSERT INTO cart (p_id, user_id, qty) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $pid, $uid, $qty);
            if ($stmt->execute()) {
                return [
                    'status' => 'success',
                    'message' => 'Your product is added successfully!'
                ];
            }
        }

        return [
            'status' => 'danger',
            'message' => 'Failed to add product to the cart. Please try again.'
        ];
    }



    // Count User cart item
    public function countUserCart($uid = null): int
    {
        if (!$uid) {
            return 0;
        }

        $stmt = $this->db->prepare("SELECT COUNT(*) AS count_item FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $uid);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        return $result['count_item'] ?? 0;
    }


    // Remove item from User Cart
    public function removeItemfromCart($remove_id, $uid): array
    {
        if (!$uid) {
            return [
                'status' => 'warning',
                'message' => 'User not logged in. Please log in to modify your cart.'
            ];
        }

        $stmt = $this->db->prepare("DELETE FROM cart WHERE p_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $remove_id, $uid);
        $stmt->execute();
        $affected_rows = $stmt->affected_rows;
        $stmt->close();

        if ($affected_rows > 0) {
            return [
                'status' => 'success',
                'message' => 'Product is removed from cart successfully!'
            ];
        }

        return [
            'status' => 'danger',
            'message' => 'Error: Product cannot be removed! Please try again...'
        ];
    }


    // Update Item from User Cart
    public function updateItemfromCart($update_id, $qty, $uid): array
    {
        if (!$uid) {
            return [
                'status' => 'warning',
                'message' => 'User not logged in. Please log in to modify your cart.'
            ];
        }

        $stmt = $this->db->prepare("UPDATE cart SET qty = ? WHERE p_id = ? AND user_id = ?");
        $stmt->bind_param("iii", $qty, $update_id, $uid);
        $stmt->execute();
        $affected_rows = $stmt->affected_rows;
        $stmt->close();

        if ($affected_rows > 0) {
            return [
                'status' => 'success',
                'message' => 'Your cart is updated!'
            ];
        }

        return [
            'status' => 'warning',
            'message' => 'Error: Product cannot be updated! Please try again...'
        ];
    }

}
?>