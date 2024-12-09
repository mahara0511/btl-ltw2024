<?php 

        if (count($parts) > 3) {
        $action = $parts[3]; 
        
        switch ($action) {
            case 'get': 
                $controller->getAboutInfo();
                break;
            case 'edit': 
                $controller->editAboutInfo();
                break;
            case 'add': 
                $controller->handleUserAdd();
                break;  
            default:
                http_response_code(404);
                echo "404 Not Found";
                break;
        }
    } else {
        $controller->handleUser();
    }
?>
