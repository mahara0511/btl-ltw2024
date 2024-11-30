<?php 
    class Model {

        public $db;
        
        public function __construct()
        {   
            include_once ROOT_PATH.'/config/db.php';
            $this->db = $con;
        }
    }
?>