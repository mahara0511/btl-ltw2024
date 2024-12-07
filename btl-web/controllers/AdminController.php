<?php

require_once 'models/AdminInfoModel.php';
require_once 'models/UserModel.php';
require_once 'models/ProductModel.php';
require_once 'models/OrderModel.php';

class AdminController
{
    private $model;
    private $userModel;
    private $productModel;
    private $orderModel;
    public function __construct($db)
    {
        $this->model = new AdminInfoModel($db);
        $this->userModel = new UserModel();
        $this->productModel = new ProductModel($db);
        $this->orderModel = new OrderModel($db);
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
        if(isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
            header('location: /admin');
            exit;
        }       
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
                    header('location: /admin');
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
        if (!isset($_SESSION['admin']) || !$_SESSION['admin'] === TRUE) {
            header('location: /admin/login'); // Chuyển hướng đến trang admin
            exit();
        }
    }

    public function index() {
        $this->isLogin();
        $number_of_users = $this->userModel->getNumberOfUsers();
        $number_of_products = $this->productModel->getNumberOfCategory();
        $number_of_orders = $this->orderModel->getNumberOfOrders();
        $all_users = $this->userModel->getAllUsers();
        $categories = $this->productModel->getCategories();

        $cate_data = [];
        while (list($cat_id, $cat_title) = mysqli_fetch_array($categories)) {
            $count = $this->productModel->getProductCountByCategory($cat_id);
            $cate_data[] = [
                'cat_id' => $cat_id,
                'cat_title' => $cat_title,
                'count' => $count,
            ];
        }

        $brands = $this->productModel->getBrands();

        $brand_data = [];
        while (list($brand_id, $brand_title) = mysqli_fetch_array($brands)) {
            $count = $this->productModel->getBrandCount($brand_id);
            $brand_data[] = [
                'brand_id' => $brand_id,
                'brand_title' => $brand_title,
                'count' => $count,
            ];
        }

        $subcribers = $this->userModel->getEmailInfo();

        include_once 'views/admin/index/index.php';
    }

    public function handleUser() {
        $this->isLogin();

        $all_users = $this->userModel->getAllUsers();
        include_once 'views/admin/handleUser.php';
    }

    public function handleUserDelete() {
        // Đọc dữ liệu JSON từ request
        $data = json_decode(file_get_contents("php://input"), true);
    
        // Kiểm tra dữ liệu đầu vào
        if (!isset($data['user_ids']) || !is_array($data['user_ids']) || count($data['user_ids']) === 0) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'No user IDs provided.']);
            exit;
        }
    
        // Chuyển ID sang mảng số nguyên
        $user_ids = array_map('intval', $data['user_ids']);
    
        // Gọi phương thức xóa
        $results = $this->userModel->deleteUsers($user_ids);
    
        // Trả về phản hồi
        header('Content-Type: application/json');
        if ($results) {
            echo json_encode(['success' => true, 'message' => 'Deleted Successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Deleted Failed.']);
        }
        exit;
    }
    
    public function handleUserEdit() {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $user_id = htmlspecialchars(trim($_POST['user_id']));
            $firstName = htmlspecialchars(trim($_POST['first_name']));
            $lastName = htmlspecialchars(trim($_POST['last_name']));
            $email = htmlspecialchars(trim($_POST['email']));
            $phone = htmlspecialchars(trim($_POST['phone']));
            $address = htmlspecialchars(trim($_POST['address']));
            $district = htmlspecialchars(trim($_POST['district']));
            $province = htmlspecialchars(trim($_POST['province']));
            header('Content-type: application/json');
    
            if (empty($user_id) || empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($address) || empty($district) || empty($province)) {
                echo json_encode(['success' => false, 'message' => 'Missing Value']);
                exit;
                return;
            }  
            $this->userModel->editUser($user_id, $firstName,$lastName,$email,$phone,$address,$district,$province);

        }



    }

    public function handleUserAdd() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {

            $firstName = htmlspecialchars(trim($_POST['first_name']));
            $lastName = htmlspecialchars(trim($_POST['last_name']));
            $email = htmlspecialchars(trim($_POST['email']));
            $password = htmlspecialchars(trim($_POST['password']));
            $phone = htmlspecialchars(trim($_POST['phone']));
            $address = htmlspecialchars(trim($_POST['address']));
            $district = htmlspecialchars(trim($_POST['district']));
            $province = htmlspecialchars(trim($_POST['province']));

            header('Content-type: application/json');
            if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($phone) || empty($address) || empty($district) || empty($province)) {
                echo json_encode(['success' => false, 'message' => 'Missing Value']);
                exit;
                return;
            }
            $password = md5($password);
            $this->userModel->addUser($firstName,$lastName,$email,$password,$phone,$address,$district,$province);
            exit;
        }
    }


    public function handleProduct() {
        $this->isLogin();

        $all_users = $this->productModel->getAllProduct();
        include_once 'views/admin/handleProduct.php';
    }

    public function handleProductDelete() {
        // Đọc dữ liệu JSON từ request
        $data = json_decode(file_get_contents("php://input"), true);
    
        // Kiểm tra dữ liệu đầu vào
        if (!isset($data['user_ids']) || !is_array($data['user_ids']) || count($data['user_ids']) === 0) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'No user IDs provided.']);
            exit;
        }
    
        // Chuyển ID sang mảng số nguyên
        $user_ids = array_map('intval', $data['user_ids']);
    
        // Gọi phương thức xóa
        $results = $this->userModel->deleteUsers($user_ids);
    
        // Trả về phản hồi
        header('Content-Type: application/json');
        if ($results) {
            echo json_encode(['success' => true, 'message' => 'Deleted Successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Deleted Failed.']);
        }
        exit;
    }
    
    public function handleProductEdit() {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $user_id = htmlspecialchars(trim($_POST['user_id']));
            $firstName = htmlspecialchars(trim($_POST['first_name']));
            $lastName = htmlspecialchars(trim($_POST['last_name']));
            $email = htmlspecialchars(trim($_POST['email']));
            $phone = htmlspecialchars(trim($_POST['phone']));
            $address = htmlspecialchars(trim($_POST['address']));
            $district = htmlspecialchars(trim($_POST['district']));
            $province = htmlspecialchars(trim($_POST['province']));
            header('Content-type: application/json');
    
            if (empty($user_id) || empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($address) || empty($district) || empty($province)) {
                echo json_encode(['success' => false, 'message' => 'Missing Value']);
                exit;
                return;
            }  
            $this->userModel->editUser($user_id, $firstName,$lastName,$email,$phone,$address,$district,$province);

        }



    }

    public function handleProductAdd() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {

            $firstName = htmlspecialchars(trim($_POST['first_name']));
            $lastName = htmlspecialchars(trim($_POST['last_name']));
            $email = htmlspecialchars(trim($_POST['email']));
            $password = htmlspecialchars(trim($_POST['password']));
            $phone = htmlspecialchars(trim($_POST['phone']));
            $address = htmlspecialchars(trim($_POST['address']));
            $district = htmlspecialchars(trim($_POST['district']));
            $province = htmlspecialchars(trim($_POST['province']));

            header('Content-type: application/json');
            if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($phone) || empty($address) || empty($district) || empty($province)) {
                echo json_encode(['success' => false, 'message' => 'Missing Value']);
                exit;
                return;
            }
            $password = md5($password);
            $this->userModel->addUser($firstName,$lastName,$email,$password,$phone,$address,$district,$province);
            exit;
        }
    }
    

}

?>