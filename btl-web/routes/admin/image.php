<?php 

        if (count($parts) > 3) {
        $action = $parts[3]; 
        
        switch ($action) {
            case 'delete': 
                $controller->deleteImage();
                break;
            case 'edit': 
                $controller->editImage();
                break;
            case 'add': 
                $controller->addImage();
                break;  
            default:
                http_response_code(404);
                include ROOT_PATH."/views/errorPage.php";
                break;
        }
    } else {
        $controller->image();
    }
?>
