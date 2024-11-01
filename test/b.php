<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once(ROOT_PATH."/component/head.php");?>
    <title>Add Product</title>
</head>
<body> 
    <div class="container">
        <h4 class="center-align">Thêm sản phẩm</h4>
        <form action="#" method="post" id="add-product-form">
            <div class="input-field">
                <input id="product_name" name="product_name" type="text" class="validate" required>
                <label for="product_name">Tên sản phẩm</label>
            </div>
            <div class="input-field">
                <input id="description" type="text" name="description" class="validate" required>
                <label for="description">Mô tả</label>
            </div>

            <div class="input-field">
                <input id="price" type="number" name="price" class="validate" required>
                <label for="price">Giá sản phẩm</label>
            </div>
            <div class="input-field">
                <input id="image" type="text" name="image" class="validate" required>
                <label for="image">Hình ảnh sản phẩm</label>
            </div>
            <div class="input-field">
                <button type="submit" class="btn waves-effect waves-light">Gửi</button>
            </div>
        </form>
    </div>


    <?php require_once(ROOT_PATH."/script_config.php"); ?> 

    <script>
        document.getElementById('add-product-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this); 

            fetch('http://localhost/api/product/add', {
                method: 'POST',
                body: formData,
            })
            .then(response => {
                console.log(response);
                return response.json();
            }
            )
            .then(data => {
                if (data.success) {
                    alert(data.message); 
                    window.location.href = 'viewAll'; 
                } else {
                    alert(data.message); 
                }
            })
            .catch(error => {
                console.error('Có lỗi xảy ra:', error);
                alert('Đã xảy ra lỗi trong quá trình thêm sản phẩm.');
            });
        });
    </script>
</body>


</html>
