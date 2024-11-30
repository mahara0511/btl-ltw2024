<?php
class CartModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getUserCartData($ip_add, $uid = null)
    {
        if (isset($uid) && $uid != null) {
            // When user is logged in
            $stmt = $this->db->prepare(
                "SELECT a.product_id, a.product_title, a.product_price, a.product_image, b.id, b.qty 
             FROM products a 
             JOIN cart b ON a.product_id = b.p_id 
             WHERE b.user_id = ?"
            );
            $stmt->bind_param("i", $uid);
        } else {
            // When user is not logged in
            $stmt = $this->db->prepare(
                "SELECT a.product_id, a.product_title, a.product_price, a.product_image, b.id, b.qty 
             FROM products a 
             JOIN cart b ON a.product_id = b.p_id 
             WHERE b.ip_add = ? AND b.user_id < 0"
            );
            $stmt->bind_param("s", $ip_add);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $cart_data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $cart_data;
    }


    public function addToCart($pid, $qty, $ip_add, $uid = null)
    {
        if (isset($uid) && $uid != null) {
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
                $stmt = $this->db->prepare("INSERT INTO cart (p_id, ip_add, user_id, qty) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("issi", $pid, $ip_add, $uid, $qty);
                if ($stmt->execute()) {
                    return [
                        'status' => 'success',
                        'message' => 'Your product is added successfully!'
                    ];
                }
            }
        } else {
            $stmt = $this->db->prepare("SELECT id FROM cart WHERE ip_add = ? AND p_id = ? AND user_id = -1");
            $stmt->bind_param("si", $ip_add, $pid);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return [
                    'status' => 'warning',
                    'message' => 'Product is already added into the cart!'
                ];
            }

            $stmt = $this->db->prepare("INSERT INTO cart (p_id, ip_add, user_id, qty) VALUES (?, ?, -1, ?)");
            $stmt->bind_param("isi", $pid, $ip_add, $qty);
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
    public function countUserCart($ip_add, $uid = null): int
    {
        if (isset($uid) && $uid != null) {
            // When user is logged in
            $stmt = $this->db->prepare("SELECT COUNT(*) AS count_item FROM cart WHERE user_id = ?");
            $stmt->bind_param("i", $uid);
        } else {
            // When user is not logged in
            $stmt = $this->db->prepare("SELECT COUNT(*) AS count_item FROM cart WHERE ip_add = ? AND user_id < 0");
            $stmt->bind_param("s", $ip_add);
        }

        $stmt->execute();
        $stmt->bind_result();
        $count_item = $stmt->fetch();
        $stmt->close();
        return $count_item['count_item'] ?? 0;
    }


    // Remove item from User Cart
    public function removeItemfromCart($remove_id, $ip_add, $uid = null): array
    {
        if (isset($uid) && $uid != null) {
            $stmt = $this->db->prepare("DELETE FROM cart WHERE p_id = ? AND user_id = ?");
            $stmt->bind_param("ii", $remove_id, $uid);
        } else {
            $stmt = $this->db->prepare("DELETE FROM cart WHERE p_id = ? AND ip_add = ?");
            $stmt->bind_param("is", $remove_id, $ip_add);
        }

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
    public function updateItemfromCart($update_id, $qty, $ip_add, $uid = null): array
    {
        if (isset($uid) && $uid != null) {
            $stmt = $this->db->prepare("UPDATE cart SET qty = ? WHERE p_id = ? AND user_id = ?");
            $stmt->bind_param("iii", $qty, $update_id, $uid);
        } else {
            $stmt = $this->db->prepare("UPDATE cart SET qty = ? WHERE p_id = ? AND ip_add = ?");
            $stmt->bind_param("iis", $qty, $update_id, $ip_add);
        }

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