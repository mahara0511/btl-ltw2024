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
}
?>