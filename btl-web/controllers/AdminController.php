<?php

require_once 'models/AdminInfoModel.php';
require_once 'models/UserModel.php';
require_once 'models/ProductModel.php';
require_once 'models/OrderModel.php';
require_once 'models/AboutInfoModel.php';
require_once 'models/newsModel.php';
class AdminController
{
    private $model;
    private $userModel;
    private $productModel;
    private $orderModel;
    private $aboutInfoModel;
    private $newsModel;
    public function __construct($db)
    {
        $this->model = new AdminInfoModel($db);
        $this->userModel = new UserModel();
        $this->productModel = new ProductModel($db);
        $this->orderModel = new OrderModel($db);
        $this->aboutInfoModel= new AboutInfoModel();
        $this->newsModel = new NewsModel();
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

    public function getAboutInfo() {
        $data = $this->aboutInfoModel->getAboutInfo();
        header("Content-type: application/json");
        echo json_encode($data);
        exit;
    }

    public function editAboutInfo() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->aboutInfoModel->editAboutInfo($_POST['phone'], $_POST['email'], $_POST['location']);
        }
    }

    public function handleUser() {
        $this->isLogin();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 30; // Số dòng hiển thị trên mỗi trang
        $offset = ($page - 1) * $limit;

        $numberOfUser = $this->userModel->getNumberOfUsers();
        $totalPages = ceil($numberOfUser / $limit);

        
        $all_users = $this->userModel->getUsersByOffset($offset, $limit);   
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

    public function handleProductDelete() {
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['product_id'])) {
            $this->productModel->deleteProduct($_GET['product_id']);
        }
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
            header("Location: /admin/handleProduct?page=$page");
            exit;    
        }
        header("Location: /admin/handleProduct");
        exit;
    }
    
    public function handleProductEdit() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $productId = isset($_POST['id']) ? htmlspecialchars(trim($_POST['id'])) : null;
            $title = isset($_POST['title']) ? htmlspecialchars(trim($_POST['title'])) : null;
            $category = isset($_POST['category']) ? htmlspecialchars(trim($_POST['category'])) : null;
            $brand = isset($_POST['brand']) ? htmlspecialchars(trim($_POST['brand'])) : null;
            $price = isset($_POST['price']) ? htmlspecialchars(trim($_POST['price'])) : null;
            $sale = isset($_POST['sale']) ? htmlspecialchars(trim($_POST['sale'])) : null;
            $description = isset($_POST['desc']) ? htmlspecialchars(trim($_POST['desc'])) : null;
            $image = isset($_POST['img']) ? htmlspecialchars(trim($_POST['img'])) : null;
        
            // Kiểm tra các biến có tồn tại hay không
            $missingFields = [];
        
            if (empty($productId)) $missingFields[] = "Product ID";
            if (empty($title)) $missingFields[] = "Title";
            if (empty($category)) $missingFields[] = "Category";
            if (empty($brand)) $missingFields[] = "Brand";
            if (empty($price)) $missingFields[] = "Price";
            if (empty($sale)) $missingFields[] = "Sale";
            if (empty($description)) $missingFields[] = "Description";
            if (empty($image)) $missingFields[] = "Image";
            header('Content-type: application/json');
            // Nếu có trường nào bị thiếu, trả về lỗi
            if (!empty($missingFields)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Missing fields: ' . implode(', ', $missingFields)
                ]);
                exit;
            }
            
            // Gọi hàm chỉnh sửa sản phẩm trong model (dưới đây là ví dụ)
            $result = $this->productModel->editProduct($category, $brand, $title, $price, $sale, $description, $image, $productId);
    
            exit;
        }
    }
    

    public function handleProductAdd() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_save'])) {
            $productData = [
                'product_name' => sanitizeInput($_POST['product_name']),
                'details' => sanitizeInput($_POST['details']),
                'price' => sanitizeInput($_POST['price']),
                'product_type' => sanitizeInput($_POST['product_type']),
                'brand' => sanitizeInput($_POST['brand']),
                'sale' => sanitizeInput($_POST['sale'])
            ];

            // Image handling
            $pictureName = $_FILES['picture']['name'];
            $pictureType = $_FILES['picture']['type'];
            $pictureTmpName = $_FILES['picture']['tmp_name'];
            $pictureSize = $_FILES['picture']['size'];

            if (
                in_array($pictureType, ["image/jpeg", "image/jpg", "image/png", "image/gif"]) &&
                $pictureSize <= 5000000
            ) {
                $imagePath = ROOT_PATH."/public/product_images/" . time() . "_" . $pictureName;
                if (move_uploaded_file($pictureTmpName, $imagePath)) {
                    $imageName = time() . "_" . $pictureName;
                    $this->productModel->addProduct($productData, $imageName);
                    header("Location: /admin/handleProduct");
                    exit;
                }
            }
        }
        $categories = $this->productModel->getCategories();
        $brands = $this->productModel->getBrands();
        include_once 'views/admin/addProduct.php';
    }
    
    public function handleProduct() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * 12;
        $products = $this->productModel->getProductByOffset($offset, 12);
        $total = $this->productModel->getNumberOFProduct();
        include_once 'views/admin/handleProduct.php';
    }

    public function setting() {
        include('views/admin/setting.php');
    }

    public function addNews() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
            // Lấy dữ liệu từ form
            $newsData = [
                'title' => sanitizeInput($_POST['title']),
                'subtitle' => sanitizeInput($_POST['subtitle']),
                'content' => sanitizeInput($_POST['content']),
                'category' => sanitizeInput($_POST['category'])
            ];
        
            // Xử lý ảnh
            $pictureName = $_FILES['picture']['name'];
            $pictureType = $_FILES['picture']['type'];
            $pictureTmpName = $_FILES['picture']['tmp_name'];
            $pictureSize = $_FILES['picture']['size'];
        
            // Kiểm tra loại ảnh và kích thước
            if (
                in_array($pictureType, ["image/jpeg", "image/jpg", "image/png", "image/gif"]) &&
                $pictureSize <= 5000000
            ) {
                // Tạo tên file và đường dẫn để lưu ảnh
                $imagePath = ROOT_PATH . "/public/img/" . time() . "_" . basename($pictureName);
                if (move_uploaded_file($pictureTmpName, $imagePath)) {
                    $imageName = time() . "_" . basename($pictureName);
        
                    // Gọi model để lưu tin tức vào cơ sở dữ liệu
                    $this->newsModel->addNews($newsData, $imageName);
        
                    // Chuyển hướng về trang quản lý tin tức
                    header("Location: /admin/news");
                    exit;
                } else {
                    echo "Failed to upload the image.";
                }
            } else {
                echo "Invalid image format or size. Please upload an image less than 5MB (JPEG, PNG, GIF).";
            }
        }
        
    }

    public function deleteNews() {
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $this->newsModel->deleteNews($_GET['id']);
        }
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
            header("Location: /admin/news?page=$page");
            exit;    
        }
        header("Location: /admin/news");
        exit;
    }

    public function news() {
        
        $perPage = 10; // Số lượng bản ghi mỗi trang
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $perPage;
        // Lấy dữ liệu từ bảng `newsdata`
        $data = $this->newsModel->getNewsData($start, $perPage);
        // Lấy tổng số bản ghi
        $totalRecords = $this->newsModel->len();
        $totalPages = ceil($totalRecords / $perPage);
        include('views/admin/news.php');
    }
}

?>