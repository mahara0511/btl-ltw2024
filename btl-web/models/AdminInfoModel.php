<?php
class AdminInfoModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
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