<?php
class StoreModel
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

    public function getProductsByBrand($brandId)
    {
        $query = $this->db->query("SELECT * FROM products,categories WHERE product_cat=cat_id AND product_brand = $brandId");

        return $query->fetch_all(MYSQLI_ASSOC);
    }

    // }
    public function getProductsByCategory($categoryId)
    {
        $query = $this->db->query("SELECT * FROM products,categories WHERE product_cat=cat_id AND product_cat = $categoryId");

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

        usort($brand_data, function ($a, $b) {
            return $b['count_items'] <=> $a['count_items'];
        });

        return $brand_data;
    }

    public function getCategories()
    {
        $cat_data = [];
        $query = $this->db->query("SELECT * FROM categories");

        if (mysqli_num_rows($query) > 0) {
            $i = 1;
            while ($row = mysqli_fetch_array($query)) {

                $cat_id = $row["cat_id"];
                $cat_title = $row["cat_title"];

                $sql = "SELECT COUNT(*) AS count_items FROM products WHERE product_cat = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param("i", $cat_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $count_row = $result->fetch_assoc();
                $count = $count_row["count_items"];

                $cat_data[] = [
                    "cat_id" => $cat_id,
                    "cat_title" => $cat_title,
                    "count_items" => $count
                ];

                $i++;
            }
        }

        usort($cat_data, function ($a, $b) {
            return $b['count_items'] <=> $a['count_items'];
        });

        return $cat_data;
    }
}
?>