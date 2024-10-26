<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once(ROOT_PATH."/component/head.php");?>
    <title>Sửa Sản Phẩm</title>
</head>
<body> 
    <div class="container">
        <h4 class="center-align">Sửa sản phẩm</h4>
        <form id="edit-product-form">

            <div class="input-field">
                <input id="product_name" value="1" name="product_name" type="text" class="validate" required>
                <label for="product_name">Tên sản phẩm</label>
            </div>
            <div class="input-field">
                <input id="description" value="1" type="text" name="description" class="validate" required>
                <label for="description">Mô tả</label>
            </div>

            <div class="input-field">
                <input id="price" value="1" type="number" name="price" class="validate" required>
                <label for="price">Giá sản phẩm</label>
            </div>
            <div class="input-field">
                <input id="image" value="1" type="text" name="image" class="validate" required>
                <label for="image">Hình ảnh sản phẩm</label>
            </div>
            <div class="input-field">
                <button type="submit" class="btn waves-effect waves-light">Gửi</button>
            </div>
        </form>
    </div>

    <?php require_once("script_config.php") ?> 

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('id');
        fetch(`http://localhost/api/product/get?id=${id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {

                if (data) {
                    document.getElementById('product_name').value = data.name;
                    document.getElementById('description').value = data.description;
                    document.getElementById('price').value = data.price;
                    document.getElementById('image').value = data.image;
                } else {
                    alert('Không tìm thấy sản phẩm');
                }
            })
            .catch(error => {
                console.error('Có lỗi xảy ra:', error);
                alert('Đã xảy ra lỗi trong quá trình lấy thông tin sản phẩm.');
            });

        document.getElementById('edit-product-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Ngăn chặn hành động mặc định của biểu mẫu

            const formData = new FormData(this); 
            
            fetch(`http://localhost/api/product/edit?id=${id}`, {
                method: 'PUT',
                body: JSON.stringify({
                    id: id,
                    product_name: document.getElementById('product_name').value,
                    description: document.getElementById('description').value,
                    price: document.getElementById('price').value,
                    image: document.getElementById('image').value
                }),
                headers: {
                    'Accept': 'application/json',
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    window.location.href = '#'; 
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Có lỗi xảy ra:', error);
                alert('Đã xảy ra lỗi trong quá trình sửa sản phẩm.');
            });
        });
    </script>
</body>
</html>
