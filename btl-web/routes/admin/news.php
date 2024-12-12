<?php 

        if (count($parts) > 3) {
        $action = $parts[3]; 
        
        switch ($action) {
            case 'delete': 
                $controller->deleteNews();
                break;
            case 'edit': 
                $controller->editNews();
                break;
            case 'add': 
                $controller->addNews();
                break;  
            default:
                http_response_code(404);
                include ROOT_PATH."/views/errorPage.php";
                break;
        }
    } else {
        $controller->news();
    }
?>
