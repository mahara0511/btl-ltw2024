<?php 
require(ROOT_PATH.'/controllers/api/apiProductsController.php');
if (isset($parts[3]) && $parts[3] == 'getAllProduct') {
    // GET Đường dẫn http://localhost/api/product/getAllProduct
    $controller = new ApiProductsController();
    $controller->getAllProducts();
} else if (isset($parts[3]) && $parts[3] == 'add') {
    // POST Đường dẫn http://localhost/api/product/add
    $controller = new ApiProductsController();
    $controller->add();
} else if (isset($parts[3]) && $parts[3] == 'get') {
    // POST Đường dẫn http://localhost/api/product/get?id=:id
    $controller = new ApiProductsController();
    $controller->get();
} else if (isset($parts[3]) && $parts[3] == 'edit') {
    // POST Đường dẫn http://localhost/api/product/get?id=:id
    $controller = new ApiProductsController();
    $controller->edit();
} else if (isset($parts[3]) && $parts[3] == 'delete') {
    // POST Đường dẫn http://localhost/api/product/delete?id=:id
    $controller = new ApiProductsController();
    $controller->delete();
}


?>