<?php
require_once('Model.php');
class NewsModel extends Model {
    public function len()
    {
        $stmt = $this->db->prepare("SELECT * FROM `news`");
        $stmt->execute();
        $result = $stmt->get_result();
        return mysqli_num_rows($result);
    }

    public function getNewsData($start, $len)
    {
        $stmt = $this->db->prepare("SELECT * FROM news ORDER BY id desc LIMIT $len OFFSET $start");
        $stmt->execute();
        $result = $stmt->get_result();
        $news_data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $news_data;
    }

    public function getAllNews()
    {
        $stmt = $this->db->prepare("SELECT * FROM news ORDER BY id");
        $stmt->execute();
        $result = $stmt->get_result();
        $news_data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $news_data;
    }

    public function deleteNews($id) {
        // Delete product image
        $query = "SELECT img FROM news WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        echo $id;
        $picture = $result->fetch_assoc()['img'];
        $path = ROOT_PATH."/public/img/$picture";
        if (file_exists($path)) {
            unlink($path);
        }

        // Delete product
        $query = "DELETE FROM news WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function addNews($newsData, $imageName) {
        {
            // Câu lệnh SQL để chèn dữ liệu
            $sql = "INSERT INTO news (title, subtitle, content, category, img) 
                    VALUES (?, ?, ?, ?, ?)";
            
            // Chuẩn bị câu lệnh
            $stmt = $this->db->prepare($sql);
    
            // Gán các giá trị từ mảng dữ liệu và tên ảnh
            $stmt->bind_param('sssss', $newsData['title'],$newsData['subtitle'],$newsData['content'],$newsData['category'],$imageName);

    
            // Thực thi câu lệnh và kiểm tra
            if ($stmt->execute()) {
                return true; // Trả về true nếu thêm thành công
            } else {
                return false; // Trả về false nếu thất bại
            }
        }
    }
    
}
?>