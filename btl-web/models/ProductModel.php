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
}
?>