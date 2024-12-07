<?php
class ProductModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getProductById($product_id)
    {
        $stmt = $this->db->prepare("
            SELECT 
                products.product_id,
                products.product_title,
                products.product_desc,
                products.product_price,
                products.product_image,
                categories.cat_id,
                brands.brand_id,
                categories.cat_title AS category,
                brands.brand_title AS brand
            FROM products
            INNER JOIN categories ON products.product_cat = categories.cat_id
            INNER JOIN brands ON products.product_brand = brands.brand_id
            WHERE products.product_id = ?
        ");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc(); // fetch_assoc for a single product
    }

    public function getRelatedProductsByCategory($product_id, $categoryId)
    {
        $query = $this->db->query("
            SELECT * FROM products,categories
            WHERE product_cat=cat_id AND product_id != $product_id AND product_cat = $categoryId
            LIMIT 4;
        ");
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    public function getNumberOfCategory(){

        $query = "SELECT cat_id FROM categories"; 
        $result = mysqli_query($this->db, $query); 
        if ($result) 
            { 
                // it return number of rows in the table. 
                return mysqli_num_rows($result);  
            }
    }

    public function getCategories()
    {
        $sql = "SELECT * FROM categories";
        $result = mysqli_query($this->db, $sql) or die("Query getCategories failed...");
        return $result;
    }

    // Đếm số lượng sản phẩm trong mỗi danh mục
    public function getProductCountByCategory($categoryId)
    {
        $sql = "SELECT COUNT(*) AS count_items FROM products WHERE product_cat = $categoryId";
        $query = mysqli_query($this->db, $sql);
        $row = mysqli_fetch_array($query);
        return $row['count_items'] ?? 0;
    }

    public function getBrands()
    {
        $sql = "SELECT * FROM brands";
        $result = mysqli_query($this->db, $sql) or die("Query getCategories failed...");
        return $result;
    }

    // Đếm số lượng sản phẩm trong mỗi danh mục
    public function getBrandCount($brandId)
    {
        $sql = "SELECT COUNT(*) AS count_items FROM products WHERE product_brand = $brandId";
        $query = mysqli_query($this->db, $sql);
        $row = mysqli_fetch_array($query);
        return $row['count_items'] ?? 0;
    }

    public function getAllProduct() {
        $sql = "SELECT products.product_id, products.product_title, categories.cat_title, brands.brand_title, products.product_price, products.product_sale, products.product_desc, products.product_image FROM products 
                JOIN brands ON products.product_brand = brands.brand_id
                JOIN categories ON products.product_cat = categories.cat_id";
        $result = mysqli_query($this->db, $sql) or die("Query getAllProduct failed...");
        return $result; 
    }

    public function getProductByOffset($offset, $limit) {
        $sql = "SELECT products.product_id, products.product_title, categories.cat_title, brands.brand_title, products.product_price, products.product_sale, products.product_desc, products.product_image FROM products 
                JOIN brands ON products.product_brand = brands.brand_id
                JOIN categories ON products.product_cat = categories.cat_id
                LIMIT $offset, $limit";
        $result = mysqli_query($this->db, $sql) or die("Query getAllProduct failed...");
        return $result; 
    }

    public function getNumberOFProduct() {
        $sql = "SELECT COUNT(*) AS total_count FROM products";
        $result = mysqli_query($this->db, $sql) or die("Query getNumberOFProduct failed...");
        $row = mysqli_fetch_assoc($result);
        return $row['total_count'];
    }

    public function deleteProduct($ids) {
        // Tạo chuỗi dấu hỏi cho truy vấn
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        // Chuẩn bị câu truy vấn
        $stmt = $this->db->prepare("DELETE FROM products WHERE product_id IN ($placeholders)");
        if (!$stmt) {
            die("Prepare failed: " . $this->db->error); // In ra lỗi của MySQL
        }
        $boundQuery = "DELETE FROM user_info WHERE user_id IN ($placeholders)";
        foreach ($ids as $value) {
            $boundQuery = preg_replace('/\?/', "'" . intval($value) . "'", $boundQuery, 1);
        }  

        $types = str_repeat('i', count($ids)); // 'i' cho kiểu số nguyên
        $stmt->bind_param($types, ...$ids);
        
        // Thực thi câu truy vấn
        $stmt->execute();
        // Kiểm tra số hàng bị ảnh hưởng
        return $stmt->affected_rows > 0;
    }

    public function addProduct($cat, $brand, $title, $price, $sale, $desc, $img) {
        // Chuẩn bị câu lệnh SQL
        $stmt = $this->db->prepare('INSERT INTO products (product_cat, product_brand, product_title, product_price, product_sale, product_desc, product_image) VALUES (?, ?, ?, ?, ?, ?, ?)');
        
        // Kiểm tra nếu câu lệnh không được chuẩn bị thành công
        if (!$stmt) {
            echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $this->db->error]);
            return false;
        }
    
        // Liên kết tham số và thực thi câu lệnh
        $stmt->bind_param('sssssss', $cat, $brand, $title, $price, $sale, $desc, $img);
    
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
                echo json_encode(['success' => false, 'message' => 'Failed to insert product: ' . $this->db->error]);
            }
            $stmt->close();
            return false;
        }
    }        

    public function editProduct($cat, $brand, $title, $price, $sale, $desc, $img, $id) {
        // Chuẩn bị câu lệnh SQL
        $stmt = $this->db->prepare('UPDATE products SET product_cat = ?, product_brand = ?, product_title = ?, product_price = ?, product_sale = ?, product_desc = ?, product_image = ? WHERE product_id = ?');
        
        // Kiểm tra nếu câu lệnh không được chuẩn bị thành công
        if (!$stmt) {
            echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $this->db->error]);
            return false;
        }
    
        // Liên kết tham số và thực thi câu lệnh
        $stmt->bind_param('sssssssi', $cat, $brand, $title, $price, $sale, $desc, $img, $id);
    
        // Thực thi câu lệnh
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Update Successfully']);
            $stmt->close();
            return true;
        } else {
            // Kiểm tra lỗi 1062 (Duplicate entry) cho email
            if ($this->db->errno == 1062) {
                echo json_encode(['success' => false, 'message' => 'Product already exists']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to insert user: ' . $this->db->error]);
            }
            $stmt->close();
            return false;
        }
    }
    
}
?>