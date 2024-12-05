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

    public function login() {
        
        if (isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE) {
            header('location: /admin/'); // Chuyển hướng đến trang admin
            exit();
        }
        echo $_SESSION['admin'];
        $email = '';
        $errors = array();
        if (isset($_POST['login_admin'])) {
            $admin_username = mysqli_real_escape_string($this->model->db, $_POST['admin_username']);
            $password = mysqli_real_escape_string($this->model->db, $_POST['password']);
            
            if (empty($admin_username)) {
                array_push($errors, "Username is required");
            }
            if (empty($password)) {
                array_push($errors, "Password is required");
            }
        
            if (count($errors) == 0) {
                $password = md5($password);
                $results = $this->model->login($admin_username, $password, $errors);

                if ($results->num_rows === 1) {
                    // Đăng nhập thành công
                    $_SESSION['admin_name'] = $admin_username;
                    $_SESSION['admin'] = TRUE;
                    $_SESSION['success'] = "You are now logged in";
                    header('location: /admin/');
                    exit(); // Luôn thêm exit sau header
                } else {
                    // Thêm lỗi vào mảng $errors
                    $errors[] = "Wrong username/password combination";
                }
            }


          }

        include 'views/admin/login.php';
    } 

    public function isLogin() {
        if(!isset($_SESSION['admin'])) {
            header('location: /admin/');
        }
    }

}

?>