<?php 
    require_once("Model.php");
    class HomeModel extends Model {
        function getProduct($start, $end) {
            if(isset($start) && isset($end)){
                $stmt = $this->db->prepare("SELECT * FROM products,categories WHERE product_cat=cat_id AND product_id BETWEEN ? AND ?"); 
                $stmt->bind_param("ii", $start, $end);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = [];
                while($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }

                return $data;
            }
        }

        function saveEmail($email){
            try {
                $stmt = $this->db->prepare("INSERT INTO email_info (email) VALUES (:email)");
                $stmt->bindParam(':email', $email);
    
                if ($stmt->execute()) {
                    // Phản hồi JSON thành công
                    echo json_encode(['status' => 'success', 'message' => 'Email subscribed successfully.']);
                } else {
                    // Phản hồi lỗi nếu lưu thất bại
                    echo json_encode(['status' => 'error', 'message' => 'Failed to subscribe email.']);
                }
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
            }
        }
    }
?>