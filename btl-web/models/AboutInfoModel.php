<?php 
    include_once "Model.php";
    class AboutInfoModel extends Model {

        public function getAboutInfo() {
            $query = 'SELECT * FROM about_info';
            $result = mysqli_query($this->db, $query);
            $data = mysqli_fetch_assoc($result);
            return $data;
        }

        public function editAboutInfo($phone, $email, $location) {
            // Chuẩn bị câu lệnh SQL
            $stmt = $this->db->prepare('UPDATE about_info SET phone_num = ?, email = ?, location = ? WHERE about_id = 1');
            
            // Kiểm tra nếu câu lệnh không được chuẩn bị thành công
            if (!$stmt) {
                echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $this->db->error]);
                return false;
            }
        
            // Liên kết tham số và thực thi câu lệnh
            $stmt->bind_param('sss', $phone, $email, $location);
        
            // Thực thi câu lệnh
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Update Successfully']);
                $stmt->close();
                return true;
            } else {
                // Kiểm tra lỗi 1062 (Duplicate entry) cho email
                if ($this->db->errno == 1062) {
                    echo json_encode(['success' => false, 'message' => 'About Info already exists']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to insert user: ' . $this->db->error]);
                }
                $stmt->close();
                return false;
            }
        }
        

    }
?>