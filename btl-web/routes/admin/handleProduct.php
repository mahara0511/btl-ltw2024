<?php 

    if (count($parts) > 3) {
        $action = $parts[3]; 
        
        switch ($action) {
            case 'delete': 
                $controller->handleProductDelete();
                break;
            case 'edit': 
                $controller->handleProductEdit();
                break;
            case 'add': 
                $controller->handleProductAdd();
                break;  
            default:
                http_response_code(404);
                echo "404 Not Found";
                break;
        }
    } else {
        $controller->handleProduct();
    }
?>
