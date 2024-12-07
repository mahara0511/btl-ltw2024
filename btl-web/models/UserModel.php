<?php 
    include "Model.php";
    class UserModel extends Model {

        public function getNumberOfUsers() {
            $stmt = $this->db->prepare("SELECT user_id FROM user_info");
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->num_rows; 
        }

        public function getAllUsers() {
            $sql = "select * from user_info";
            $result = mysqli_query($this->db, $sql) or die("Query getCategories failed...");
            return $result;
        }

        public function getEmailInfo() {
            $sql = "select * from email_info";
            $result = mysqli_query($this->db, $sql) or die("Query getCategories failed...");
            return $result;
        }

        public function deleteUsers($user_ids) {
            // Tạo chuỗi dấu hỏi cho truy vấn
            $placeholders = implode(',', array_fill(0, count($user_ids), '?'));

            // Chuẩn bị câu truy vấn
            $stmt = $this->db->prepare("DELETE FROM user_info WHERE user_id IN ($placeholders)");
            if (!$stmt) {
                die("Prepare failed: " . $this->db->error); // In ra lỗi của MySQL
            }
            $boundQuery = "DELETE FROM user_info WHERE user_id IN ($placeholders)";
            foreach ($user_ids as $value) {
                $boundQuery = preg_replace('/\?/', "'" . intval($value) . "'", $boundQuery, 1);
            }  

            $types = str_repeat('i', count($user_ids)); // 'i' cho kiểu số nguyên
            $stmt->bind_param($types, ...$user_ids);
            
            // Thực thi câu truy vấn
            $stmt->execute();
            // Kiểm tra số hàng bị ảnh hưởng
            return $stmt->affected_rows > 0;
        }
        
    }
?>