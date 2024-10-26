<?php 
    require(ROOT_PATH.'/controllers/ProductController.php');
    $controller = new ProductController();
    if (isset($parts[2]) && $parts[2] == 'viewAll') {
        // Đường dẫn /product/viewAll
        $controller->viewAll(); // Phương thức xử lý cho việc xem sản phẩm
    } elseif (isset($parts[2]) && $parts[2] == 'edit') {
        // Đường dẫn /product/edit
        $controller->edit(); // Phương thức xử lý cho việc chỉnh sửa sản phẩm
    } elseif (isset($parts[2]) && $parts[2] == 'delete') {
        // Đường dẫn /product/delete
        $controller->delete(); // Phương thức xử lý cho việc xóa sản phẩm
    } elseif (isset($parts[2]) && $parts[2] == 'add') {
        // Đường dẫn /product/create
        $controller->add(); // Phương thức xử lý cho việc thêm sản phẩm
    } 
    else {
        // Đường dẫn /product mà không có đường dẫn con cụ thể
        $controller->index();
    }
?>