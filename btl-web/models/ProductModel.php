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
}
?>