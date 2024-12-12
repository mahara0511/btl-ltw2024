<?php
require_once ROOT_PATH . "/views/layouts/header.php";
?>

<link rel="stylesheet" href="public/css/orders.css">
<script src="public/js/order-details.js"></script>

<div class="container" style>
    <div class="table-container">
        <table class="responsive-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Payer</th>
                    <th>Card Number</th>
                    <th>Order Date</th>
                    <th>Address</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr data-order-id="<?= $order['order_id'] ?>">
                        <td data-label="Order ID"><?= $order['order_id'] ?></td>
                        <td data-label="Payer"><?= $order['cardname'] ?></td>
                        <td data-label="Card Number"><?= $order['cardnumber'] ?></td>
                        <td data-label="Order Date"><?= date('d-m-Y', strtotime($order['order_date'])) ?></td>
                        <td data-label="Address">
                            <?= $order['address'] . ', ' . $order['district'] . ', ' . $order['province'] ?>
                        </td>
                        <td data-label="Quantity"><?= $order['prod_count'] ?></td>
                        <td data-label="Total Price"><?= ((int) $order['total_amt']) ?>$</td>
                        <td data-label="Status"
                            class="status <?= time() - strtotime($order['order_date']) > 7 * 24 * 60 * 60 ? 'Delivered' : 'Delivering' ?>">
                            <?= time() - strtotime($order['order_date']) > 7 * 24 * 60 * 60 ? 'Delivered' : 'Delivering' ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



<?php
require_once ROOT_PATH . "/views/layouts/footer.php";
?>