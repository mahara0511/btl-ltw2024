<?php
require_once('Model.php');
class newsModel extends Model {
    public function getNewsData($N)
    {
        $stmt = $this->db->prepare("SELECT * FROM news ORDER BY id desc limit $N");
        
        $stmt->execute();
        $result = $stmt->get_result();
        $news_data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $news_data;
    }
}
?>