<?php 
    if (isset($parts[2]) && $parts[2] == 'product') {
        // Đường dẫn api/product/
        require('product.php');
    } else {
        echo"<script>alert('Đường dẫn api/product')</script>";
    }
?>