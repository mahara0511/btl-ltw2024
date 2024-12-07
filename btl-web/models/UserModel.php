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

        public function getUsersByOffset($offset, $limit) {
            $query = "SELECT * FROM user_info LIMIT $offset, $limit";
            $data = mysqli_query($this->db, $query);
            return $data;
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

        public function addUser($firstName, $lastName, $email, $password, $phone, $address, $district, $province) {
            // Chuẩn bị câu lệnh SQL
            $stmt = $this->db->prepare('INSERT INTO user_info (first_name, last_name, email, password, mobile, address, district, province) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
            
            // Kiểm tra nếu câu lệnh không được chuẩn bị thành công
            if (!$stmt) {
                echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $this->db->error]);
                return false;
            }
        
            // Liên kết tham số và thực thi câu lệnh
            $stmt->bind_param('ssssssss', $firstName, $lastName, $email, $password, $phone, $address, $district, $province);
        
            // Thực thi câu lệnh
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Inserted Successfully']);
                $stmt->close();
                return true;
            } else {
                // Kiểm tra lỗi 1062 (Duplicate entry) cho email
                if ($this->db->errno == 1062) {
                    echo json_encode(['success' => false, 'message' => 'Email already exists']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to insert user: ' . $this->db->error]);
                }
                $stmt->close();
                return false;
            }
        }        

        public function editUser($user_id, $firstName,$lastName,$email,$phone,$address,$district,$province) {
            // Chuẩn bị câu lệnh SQL
            $stmt = $this->db->prepare('UPDATE user_info SET first_name = ?, last_name = ?, email = ?, mobile = ?, address = ?, district = ?, province = ? WHERE user_id = ?');
            
            // Kiểm tra nếu câu lệnh không được chuẩn bị thành công
            if (!$stmt) {
                echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $this->db->error]);
                return false;
            }
        
            // Liên kết tham số và thực thi câu lệnh
            $stmt->bind_param('sssssssi', $firstName, $lastName, $email, $phone, $address, $district, $province, $user_id);
        
            // Thực thi câu lệnh
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Update Successfully']);
                $stmt->close();
                return true;
            } else {
                // Kiểm tra lỗi 1062 (Duplicate entry) cho email
                if ($this->db->errno == 1062) {
                    echo json_encode(['success' => false, 'message' => 'Email already exists']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to insert user: ' . $this->db->error]);
                }
                $stmt->close();
                return false;
            }
        }
        

    }
?>