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
                include('handleUser.php');
                break;
            case 'handleProduct': 
                include('handleProduct.php');
                break;  
            case 'aboutInfo':
                include('aboutInfo.php');
                break;
            case 'news':
                include('news.php');
                break;
            case 'image':
                include('image.php');
                break;
            case 'setting': {
                $controller->setting();
                break;
            }
            default:
                http_response_code(404);
                include ROOT_PATH."/views/errorPage.php";
                break;
        }
    } else {
        // Nếu chỉ có 1 phần (chẳng hạn /admin), gọi index
        $controller->index();
    }
?>
