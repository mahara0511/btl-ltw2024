<?php
// models/Product.php

class Product {
    // Phương thức lấy tất cả sản phẩm
    public function getAllProducts() {
        require("config/db_connect.php");
        $stmt = $conn->prepare("SELECT * FROM products");
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        $num_rows = $result->num_rows; 
            if($num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $product[] = $row;
                }
            }
        $stmt->close();
        $conn->close();
        return $product;

    }   

    public function get() {
        require("config/db_connect.php");
        $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $products;
        $num_rows = $result->num_rows; 
            if($num_rows > 0) {
                $row = $result->fetch_assoc();
                    $product = $row;
            }
        $stmt->close();
        $conn->close();
        return $product;

    }   

    public function add() {
        require("config/db_connect.php");
    $response = [];

        if (isset($_POST['product_name']) &&
            isset($_POST['description']) &&
            isset($_POST['price']) &&
            isset($_POST['image'])) {
            
            $product_name = htmlspecialchars($_POST['product_name']);
            $description = htmlspecialchars($_POST['description']);
            $price = htmlspecialchars($_POST['price']);
            $image = htmlspecialchars($_POST['image']);
            
            $stmt = $conn->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('ssis', $product_name , $description, $price, $image);
            
            if ($stmt->execute()) {
                $response = ['success' => true, 'message' => 'Thêm sản phẩm thành công!'];
            } else {
                $response = ['success' => false, 'message' => 'Thêm sản phẩm không thành công!'];
            }
            
            $stmt->close();
        } else {
            $response = ['success' => false, 'message' => 'Thông tin không hợp lệ!'];
        }
        
        $conn->close();
        return $response;
    }   

    public function edit() {
        require("config/db_connect.php");
        
        // Lấy dữ liệu từ body yêu cầu
        $data = json_decode(file_get_contents("php://input"), true);
        $id = intval($data['id']); // Lấy ID từ dữ liệu JSON
    
        $response = [];
        
        if (isset($data['product_name']) && 
            isset($data['description']) && 
            isset($data['price']) && 
            isset($data['image'])) {
            
            $product_name = htmlspecialchars($data['product_name']);
            $description = htmlspecialchars($data['description']);
            $price = htmlspecialchars($data['price']);
            $image = htmlspecialchars($data['image']);
        
            $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?");
            $stmt->bind_param('ssisi', $product_name, $description, $price, $image, $id);
        
            if ($stmt->execute()) {
                $response = ['success' => true, 'message' => 'Cập nhật sản phẩm thành công!'];
            } else {
                $response = ['success' => false, 'message' => 'Cập nhật sản phẩm không thành công!'];
            }
        
            $stmt->close();
        } else {
            $response = ['success' => false, 'message' => 'Thông tin không hợp lệ!'];
        }
        
        $conn->close();
        return $response;
    }
    
}
?>