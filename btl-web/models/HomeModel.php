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
    }
?>