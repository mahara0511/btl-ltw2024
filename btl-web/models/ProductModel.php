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

    public function     deleteComment($commentId)
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
}
?>