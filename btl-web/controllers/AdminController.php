<?php
require_once 'models/AdminInfoModel.php';

class AdminController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new AdminInfoModel($db);
    }

    public function getAdmin($admin_id)
    {
        $admin_info = $this->model->getAdminById($admin_id);
        include 'views/admin_view.php';
    }

    public function createAdmin($name, $email, $password)
    {
        $this->model->addAdmin($name, $email, $password);
    }
}

?>