<?php
require_once 'models/ProductModel.php';

class ProductController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new ProductModel($db);
    }
    public function view_product_detail($product_id)
    {
        $product_detail = $this->model->getProductById($product_id);
        $related_products = $this->getRelatedProducts($product_id, $product_detail['cat_id']);
        $comments = $this->model->getCommentsByProID($product_id);
        require_once 'views/product.php';
    }
    public function getRelatedProducts($product_id, $cat_id)
    {
        return $this->model->getRelatedProductsByCategory($product_id, $cat_id);
    }

    public function addNewComment()
    {
        header('Content-Type: application/json');

        $user_id = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;
        $product_id = $_POST['p_id'];
        $content = htmlspecialchars(stripslashes(trim($_POST['content'])));
        $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : null;
        if (empty($user_id)) {
            echo json_encode(['success' => false, 'message' => 'Not logged in']);
            exit;
        }
        if (empty($content)) {
            echo json_encode(['success' => false, 'message' => 'The content must be not empty.']);
            exit;
        }
        if ($this->model->addCommentsToProduct($user_id, $product_id, $content, $parent_id)) {
            echo json_encode(['success' => true, 'message' => 'Add your comment successfully']);
            exit;
        }
        echo json_encode(['success' => false, 'message' => 'Invalid data.']);
        exit;
    }

    public function updateComment()
    {
        header('Content-Type: application/json');

        try {
            $input = json_decode(file_get_contents('php://input'), true);

            $commentId = $input['commentId'] ?? null;
            $newContent = $input['content'] ?? '';

            if ($commentId && $newContent) {
                $success = $this->model->updateComment($commentId, $newContent);
                echo json_encode(['success' => $success]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid input']);
            }
        } catch (Exception $e) {
            error_log("Error in updateComment: " . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Server error']);
        }

        exit;
    }

    public function deleteComment()
    {
        header('Content-Type: application/json');

        $input = json_decode(file_get_contents('php://input'), true);
        $commentId = $input['commentId'] ?? null;

        if ($commentId) {
            $success = $this->model->deleteComment($commentId);
            echo json_encode(['success' => $success]);
            exit;
        }
        echo json_encode(['success' => false, 'message' => 'Invalid comment ID']);
        exit;
    }


}
