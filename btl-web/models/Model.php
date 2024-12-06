<?php 
    class Model {

        public $db;
        
        public function __construct()
        {   
            include ROOT_PATH.'/config/db.php';
            $this->db = $con;
        }
    }
?>