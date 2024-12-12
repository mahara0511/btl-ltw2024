<?php 

        if (count($parts) > 3) {
        $action = $parts[3]; 
        
        switch ($action) {
            case 'delete': 
                $controller->handleUserDelete();
                break;
            case 'edit': 
                $controller->handleUserEdit();
                break;
            case 'add': 
                $controller->handleUserAdd();
                break;  
            default:
                http_response_code(404);
                include ROOT_PATH."/views/errorPage.php";
                break;
        }
    } else {
        $controller->handleUser();
    }
?>
