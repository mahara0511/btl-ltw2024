<h1>Your Orders</h1>
<ul>
    <?php foreach ($orders as $order): ?>
        <li>Order ID: <?php echo $order['order_id']; ?>, Status: <?php echo $order['p_status']; ?></li>
    <?php endforeach; ?>
</ul>