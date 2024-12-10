<?php
// Đường dẫn đến thư mục lưu trữ ảnh
$uploadDir = 'public/product_images/';


// Lấy danh sách ảnh trong thư mục
$images = array_filter(scandir($uploadDir), function ($file) use ($uploadDir) {
    return in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif']);
});
$images = array_values($images); // Reset lại chỉ số mảng

// Phân trang
$imagesPerPage = 12; // Số lượng ảnh mỗi trang
$totalImages = count($images); // Tổng số ảnh
$totalPages = ceil($totalImages / $imagesPerPage); // Tổng số trang
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Trang hiện tại
$currentPage = max(1, min($currentPage, $totalPages)); // Đảm bảo giá trị hợp lệ

// Lấy ảnh cho trang hiện tại
$startIndex = ($currentPage - 1) * $imagesPerPage;
$imagesToShow = array_slice($images, $startIndex, $imagesPerPage);

include('layouts/sidenav.php');
include('layouts/topheader.php');
?>

<style>
        .gallery {
            display: flex;
            flex-wrap: wrap;
        }

        .gallery img {
            width: 200px; /* Giữ nguyên chiều rộng */
            height: 200px; /* Giữ nguyên chiều cao */
            object-fit: cover;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .gallery div {
            width: 16.666%;
            display: flex;
            flex-direction: column;
            align-items: center; /* Căn giữa nội dung (nếu có thêm text hoặc nút) */
            margin-right: 25px;
        }

        .gallery div a {
            display: block;
            background-color: red;
            color: white;
            text-align: center;
            text-decoration: none;
            font-weight: 500;
            padding: 2px 5px;
            font-size: 12px;
            border-radius: 3px;
            width: 100%;
        }

        .gallery div span {
            color: #fff;
            display: block;
            width: 100%;
        }

        .upload-form {
            margin-bottom: 20px;
        }
        .pagination {
            margin-top: 20px;
        }
        .pagination a {
            margin: 0 5px;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #ccc;
            color: #fff;
        }
        .pagination a.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
    </style>
<div class="content">
  <div class="container-fluid">
    <h1>Image Gallery</h1>

    <!-- Form Upload -->
    <form class="upload-form" method="POST" enctype="multipart/form-data">
        <label class="btn btn-success" for="input-img">Add Image</label>
        <input id="input-img" style="display: none" type="file" name="image" accept="image/*" required>
        <button class= "btn btn-primary" type="submit">Upload Image</button>
    </form>

    <!-- Hiển thị ảnh -->
    <div class="gallery">
        <?php foreach ($imagesToShow as $image): ?>
            <div class="img-content">
                <img src="<?php echo '../'.$uploadDir . $image; ?>" alt="Image">
                <span><?php echo $image?></span>
                <a href="?delete=<?php echo urlencode($image); ?>" 
                onclick="return confirm('Are you sure you want to delete this image?');">
                DELETE
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Phân trang -->
    <ul class="pagination">
        <?php
        // Số trang muốn hiển thị
        $maxPagesToShow = 10;

        // Tìm trang bắt đầu và trang kết thúc để hiển thị
        $startPage = max(1, $currentPage - floor($maxPagesToShow / 2));
        $endPage = min($totalPages, $startPage + $maxPagesToShow - 1);

        // Điều chỉnh lại nếu $endPage bị lệch so với tổng số trang
        if ($endPage - $startPage + 1 < $maxPagesToShow) {
            $startPage = max(1, $endPage - $maxPagesToShow + 1);
        }
        ?>

        <!-- Nút Previous -->
        <?php if ($currentPage > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>">Previous</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <a class="page-link" href="#">Previous</a>
            </li>
        <?php endif; ?>

        <!-- Hiển thị các trang -->
        <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
            <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>

        <!-- Nút Next -->
        <?php if ($currentPage < $totalPages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>">Next</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <a class="page-link" href="#">Next</a>
            </li>
        <?php endif; ?>
    </ul>

  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 
if (isset($_GET['delete'])) {
    $fileToDelete = $uploadDir . basename($_GET['delete']);
    if (file_exists($fileToDelete)) {
        unlink($fileToDelete);
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'Image deleted successfully!',
            })
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'File does not exist!',
            });
        </script>";
    }
}

// Xử lý thêm ảnh
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $uploadedFile = $_FILES['image'];
    $fileName = basename($uploadedFile['name']);
    $targetPath = $uploadDir . $fileName;

    // Kiểm tra file hợp lệ
    $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (in_array($fileExtension, $validExtensions)) {
        if (move_uploaded_file($uploadedFile['tmp_name'], $targetPath)) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Uploaded!',
                    text: 'Image uploaded successfully!',
                })
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Upload Failed',
                    text: 'Failed to upload image!',
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Invalid File Type',
                text: 'Only JPG, JPEG, PNG, and GIF are allowed.',
            });
        </script>";
    }
}

?>
</body>
</html>
