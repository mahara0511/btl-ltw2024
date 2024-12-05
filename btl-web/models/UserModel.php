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
    }
?>