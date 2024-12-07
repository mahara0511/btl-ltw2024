<?php
class AdminInfoModel
{
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function login($admin_username, $password, &$errors) {

        // Chuẩn bị câu truy vấn
        $stmt = $this->db->prepare("SELECT * FROM admin_info WHERE admin_email=? AND admin_password=?");
        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->error); // Báo lỗi nếu prepare thất bại
        }
        
        // Gắn tham số
        $stmt->bind_param('ss', $admin_username, $password);
        // Thực thi câu truy vấn
        $stmt->execute();
        // Lấy kết quả
        $results = $stmt->get_result();
        $stmt->close();
        return $results;
    }
    

    public function getAdminById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM admin_info WHERE admin_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();

    }

    public function addAdmin($name, $email, $password)
    {
        $query = $this->db->prepare("INSERT INTO admin_info (admin_name, admin_email, admin_password) VALUES (?, ?, ?)");
        $query->execute([$name, $email, $password]);
    }

    
}
?>