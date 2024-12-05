<?php 
    require_once(ROOT_PATH . '/controllers/AdminController.php');
    require_once(ROOT_PATH. '/config/db.php');

    $controller = new AdminController($con);
        if (count($parts) > 2) {
        $action = $parts[2]; 
        
        switch ($action) {
            case 'login':
                $controller->login();
                break;
            case 'handleUser': 
                $controller->handleUser();
                break;
            default:
                http_response_code(404);
                echo "404 Not Found";
                break;
        }
    } else {
        // Nếu chỉ có 1 phần (chẳng hạn /admin), gọi index
        $controller->index();
    }
?>
