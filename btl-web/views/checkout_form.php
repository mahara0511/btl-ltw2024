<?php
require_once ROOT_PATH . "/views/layouts/header.php";
?>
<link type="text/css" rel="stylesheet" href="public/css/checkout.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Handle form submission
        $('#checkout-form form').submit(function (e) {
            e.preventDefault();
            const formData = {
                f_name: $('#f_name').val(),
                email: $('#email').val(),
                address: $('#address').val(),
                district: $('#district').val(),
                province: $('#province').val(),
                cardname: $('#cardname').val(),
                cardnumber: $('#cardnumber').val(),
                total_amt: $('#total_amt').val(),
                products: []
            };

            $('.productInput').each(function () {
                formData.products.push({
                    product_id: $(this).data('product-id'),
                    qty: $(this).data('quantity'),
                    amt: $(this).data('price')
                });
            });

            $.ajax({
                url: '/place-order', // Your server endpoint
                type: 'POST',
                data: JSON.stringify(formData), // Convert data to JSON format
                contentType: 'application/json', // Set the content type to JSON
                dataType: 'json', // Expecting JSON response
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                        alert(response.message);
                        window.location.href = '/';
                    } else {
                        alert('Error placing order: ' + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert('AJAX Error: ' + error);
                }
            });
        });
    });
</script>



<div class="container" id="checkout-form">
    <?php
    $user_data = $showOrderData['user_data'] ?? [];
    $order_items = $showOrderData['order_items'] ?? [];
    $total_price = $showOrderData['total_price'] ?? 0;

    ?>
    <h2 class="text-center my-4">Checkout Form</h2>
    <form action="/place-order" method="post">
        <div class="form-group">
            <label for="f_name">Full Name</label>
            <input type="text" name="f_name" id="f_name" class="form-control"
                value="<?= $user_data['first_name'] . ' ' . $user_data['last_name'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="example@gamil.com"
                value="<?= $user_data['email'] ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" placeholder="Enter address (i.e 268 Ly Thuong Kiet)" name="address" id="address"
                value="<?= $user_data['address'] ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="district">District</label>
            <input type="text" name="district" id="district" placeholder="Enter district/city (i.e Quan 10, Thu Duc)"
                value="<?= $user_data['district'] ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="province">Provice</label>
            <input type="text" name="province" id="province" placeholder="Enter province (i.e Ho Chi Minh, Binh Duong)"
                value="<?= $user_data['province'] ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="cardname">Cardholder Name</label>
            <input type="text" name="cardname" id="cardname" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="cardnumber">Card Number</label>
            <input type="text" name="cardnumber" id="cardnumber" class="form-control" required>
        </div>

        <!-- Hidden fields to send cart data to the backend -->
        <?php foreach ($order_items as $item): ?>
            <input type="hidden" class="productInput" data-product-id="<?= $item['product_id'] ?>"
                data-quantity="<?= $item['qty'] ?>" data-price="<?= (int) $item['price'] * $item['qty'] ?>">
        <?php endforeach; ?>

        <div class="form-group">
            <label for="total_amt">Total Price: </label>
            <input type="number" name="total_amt" id="total_amt" value="<?= $total_price ?>" class="form-control"
                readonly> ($)

        </div>
        <button type="submit" class="btn btn-primary btn-block">Place Order</button>
    </form>
</div>

<?php
require_once ROOT_PATH . "/views/layouts/footer.php";
?>