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
                products.product_sale,
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

    public function getCommentsByProID($product_id)
    {
        $stmt = $this->db->prepare("
                SELECT
                u.first_name AS commenter_first_name,
                u.last_name AS commenter_last_name,
                c.*,
                up.first_name AS parent_first_name,
                up.last_name AS parent_last_name
            FROM comments c
            JOIN user_info u ON c.user_id = u.user_id
            LEFT JOIN comments parent ON c.parent_id = parent.cmt_id
            LEFT JOIN user_info up ON parent.user_id = up.user_id
            WHERE c.p_id = ?
            ORDER BY c.cmt_date ASC;
        ");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
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

    public function addCommentsToProduct($user_id, $product_id, $content, $parent_id = null)
    {
        if ($user_id && !empty($content) && $product_id) {
            $stmt = $this->db->prepare("
                INSERT INTO comments (user_id, p_id, parent_id, cmt_date, content, created_at)
                VALUES (?, ?, ?, NOW(), ?, NOW())
            ");

            $stmt->bind_param('iiis', $user_id, $product_id, $parent_id, $content);

            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                return false;
            }
        }
        return false;
    }


    public function updateComment($commentId, $newContent)
    {
        try {
            $query = "UPDATE comments SET content = ?, updated_at = NOW() WHERE cmt_id = ?";
            $stmt = $this->db->prepare($query);

            if (!$stmt) {
                throw new Exception("Prepare failed: " . $this->db->error);
            }

            $stmt->bind_param('si', $newContent, $commentId);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed: " . $stmt->error);
            }

            return true;
        } catch (Exception $e) {
            error_log("Failed to update comment: " . $e->getMessage());
            return false;
        } finally {
            if (isset($stmt) && $stmt) {
                $stmt->close();
            }
        }
    }

    public function deleteComment($commentId)
    {
        try {
            // Start a transaction to ensure atomicity
            $this->db->begin_transaction();

            // First, delete all child comments recursively
            $queryDeleteChildren = "DELETE FROM comments WHERE parent_id = ?";
            $stmtChildren = $this->db->prepare($queryDeleteChildren);
            if (!$stmtChildren) {
                throw new Exception("Prepare failed for child comments: " . $this->db->error);
            }
            $stmtChildren->bind_param('i', $commentId);
            if (!$stmtChildren->execute()) {
                throw new Exception("Execute failed for child comments: " . $stmtChildren->error);
            }

            // Then, delete the comment itself
            $queryDeleteComment = "DELETE FROM comments WHERE cmt_id = ?";
            $stmtComment = $this->db->prepare($queryDeleteComment);
            if (!$stmtComment) {
                throw new Exception("Prepare failed for comment: " . $this->db->error);
            }
            $stmtComment->bind_param('i', $commentId);
            if (!$stmtComment->execute()) {
                throw new Exception("Execute failed for comment: " . $stmtComment->error);
            }

            // Commit the transaction
            $this->db->commit();

            return true;

        } catch (Exception $e) {
            // Rollback in case of error
            $this->db->rollback();
            error_log("Failed to delete comment: " . $e->getMessage());
            return false;
        } finally {
            // Close prepared statements
            if (isset($stmtChildren) && $stmtChildren) {
                $stmtChildren->close();
            }
            if (isset($stmtComment) && $stmtComment) {
                $stmtComment->close();
            }
        }
    }
    public function getNumberOfCategory()
    {

        $query = "SELECT cat_id FROM categories";
        $result = mysqli_query($this->db, $query);
        if ($result) {
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

    public function deleteProduct($product_id) {
        // Delete product image
        $query = "SELECT product_image FROM products WHERE product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $picture = $result->fetch_assoc()['product_image'];
        $path = ROOT_PATH."/public/product_images/$picture";
        if (file_exists($path)) {
            unlink($path);
        }

        // Delete product
        $query = "DELETE FROM products WHERE product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $product_id);
        return $stmt->execute();
    }

    public function addProduct($data, $imagePath) {
        $query = "INSERT INTO products (product_cat, product_brand, product_title, product_price, product_desc, product_image, product_sale) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "iisdsss",
            $data['product_type'],
            $data['brand'],
            $data['product_name'],
            $data['price'],
            $data['details'],
            $imagePath,
            $data['sale']
        );
        return $stmt->execute();
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