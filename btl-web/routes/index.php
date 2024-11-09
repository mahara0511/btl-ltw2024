<?php 
$request = $_SERVER['REQUEST_URI'];
$request = parse_url($request, PHP_URL_PATH);

$parts = explode('/', $request);
    switch ($parts[1]) {
        case '':
            require(ROOT_PATH . '/controllers/HomeController.php');
            $controller = new HomeController();
            $controller->index();
            break;
        case 'about_us':
            require(ROOT_PATH . '/controllers/AboutUsController.php');
            $controller = new AboutUsController();
            $controller->index();
            break;
        default:
            http_response_code(404);
            echo "404 Not Found";
            break;
    }
?>
