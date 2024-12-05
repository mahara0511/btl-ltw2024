<?php 
    require_once(ROOT_PATH . '/controllers/AdminController.php');
    require_once(ROOT_PATH. '/config/db.php');
    $controller = new AdminController($con); 
    switch ($parts[2]) {
        case 'login':
            $controller->login();
            break;
        default:
            http_response_code(404);
            echo "404 Not Found";
            break;
        }
?>