<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    $_SESSION['uid'] = 2;
}

function sanitizeInput($data)
{
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

define('ROOT_API', 'http://localhost');
define('ROOT_PATH', __DIR__);
require_once("routes/index.php");
?>