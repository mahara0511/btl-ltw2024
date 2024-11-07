<?php
class ProductModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllProducts()
    {
        $query = $this->db->query("SELECT * FROM products,categories WHERE product_cat=cat_id");

        return $query->fetch_all(MYSQLI_ASSOC);
    }
    public function getTopProducts($start = 0, $limit = 5)
    {
        $query = $this->db->query("SELECT * FROM products,categories WHERE product_cat=cat_id LIMIT $start,$limit");

        return $query->fetch_all(MYSQLI_ASSOC);
    }

    public function getBrands()
    {
        $brand_data = [];
        $query = $this->db->query("SELECT * FROM brands");

        if (mysqli_num_rows($query) > 0) {
            $i = 1;
            while ($row = mysqli_fetch_array($query)) {

                $bid = $row["brand_id"];
                $brand_name = $row["brand_title"];

                $sql = "SELECT COUNT(*) AS count_items FROM products WHERE product_brand = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param("i", $bid);
                $stmt->execute();
                $result = $stmt->get_result();
                $count_row = $result->fetch_assoc();
                $count = $count_row["count_items"];

                $brand_data[] = [
                    "brand_id" => $bid,
                    "brand_title" => $brand_name,
                    "count_items" => $count
                ];

                $i++;
            }
        }

        return $brand_data;
    }

    public function getProductById($product_id)
    {
        $query = $this->db->prepare("SELECT * FROM products WHERE product_id = ?");
        $query->execute([$product_id]);
        return $query->fetch();
    }
}
?>