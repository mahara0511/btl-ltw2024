<?php
    class HomeController {

    private $model;

    public function __construct()
    {
        require_once(ROOT_PATH . "\models\HomeModel.php");
        $this->model = new HomeModel();
    }
        public function index() {
            
            $products1 = $this->model->getProduct(70, 75);
            $products2 = $this->model->getProduct(59, 65);
            require(ROOT_PATH.'/views/pages/homePageView/index.php');
        }

        public function contact_us() {
            require(ROOT_PATH.'/views/contact.php');
        }

        public function news() {
            require(ROOT_PATH.'/views/news.php');
        }

        public function postEmail() {
            // Lấy dữ liệu JSON từ yêu cầu
            $input = file_get_contents("php://input");
            
            // Giải mã JSON thành mảng PHP
            $data = json_decode($input, true);
            
            // Kiểm tra dữ liệu hợp lệ
            if (isset($data['email']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $email = htmlspecialchars($data['email']);
                
                // Giả sử bạn lưu email vào cơ sở dữ liệu (DB)
                // Ví dụ (PDO):
                $this->model->saveEmail($email);
            } else {
                // Phản hồi lỗi nếu email không hợp lệ
                echo json_encode(['status' => 'error', 'message' => 'Invalid email address.']);
            }

            exit;
        }
        
    }

?>
