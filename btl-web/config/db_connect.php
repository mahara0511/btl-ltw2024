<?php
$servername = "localhost";
$user = "root";
$password = "";
$dbname = "onlineshop";

$conn = new mysqli($servername, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Failed connection: " . $conn->connect_error);
}
?>