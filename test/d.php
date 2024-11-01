<?php
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        require_once("db_connect.php");
            $id = htmlspecialchars($_GET['id']);
            $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
            $stmt->bind_param('i', $id);
            if($stmt->execute()) {
                echo "<script>alert('Thêm sản phẩm thành công!')</script>";
                $stmt->close();
                header("Location: a.php");
            } else {
                echo "<script>alert('Insert failed!')</script>";
            };

            $conn->close();
    } else echo "<script>alert('Nhập đúng và đủ thông tin')</script>";
?>