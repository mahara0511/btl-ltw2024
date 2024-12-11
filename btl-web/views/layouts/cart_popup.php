<?php
require_once(ROOT_PATH . '/controllers/CartController.php');
require(ROOT_PATH . '/config/db_connect.php');
$cartController = new CartController($conn);
?>

<div class="dropdown">
    <?php
    // Get cart data for logged-in user
    $cart_data = isset($_SESSION['uid']) ? $cartController->view_cart_dropdown($_SESSION['uid']) : [];
    $cart_items = $cart_data['cart_items'] ?? null;
    $total_price = $cart_data['total_price'] ?? 0;
    ?>
    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <i class="fa fa-shopping-cart"></i>
        <span>Your Cart</span>
        <div class="badge qty" id="cartItemCount">
            <?= count($cart_items ?? []); ?>
        </div>
    </a>
    <div class="cart-dropdown">
        <div class="cart-list" id="cart_product">
            <?php if (!empty($cart_items)): ?>
                <?php foreach ($cart_items as $item): ?>
                    <div class="product-widget"
                        onclick="window.location.href='/store?product_id=<?php echo $item['product_id']; ?>'">
                        <div class="product-img">
                            <img src="<?= 'public/product_images/' . htmlspecialchars($item['product_image']); ?>"
                                alt="<?= htmlspecialchars($item['product_title']); ?>">
                        </div>
                        <div class="product-body">
                            <h3 class="product-name"><a
                                    href="/store?product_id=<?= $item['product_id'] ?>"><?= htmlspecialchars($item['product_title']); ?></a>
                            </h3>
                            <h4 class="product-price">
                                <span class="qty"><?= $item['qty']; ?></span> x $<?= round($item['product_price']); ?>
                            </h4>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="cart-summary">
                    <small class="qty"><?= count($cart_items) . " Item(s) in cart" ?></small>
                    <h5>Total price : $<?= round($total_price, 0) ?></h5>
                </div>
            <?php endif; ?>
        </div>
        <div class="cart-btns">
            <a href="/view_cart" style="width:100%;"><i class="fa fa-edit"></i> edit cart</a>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.dropdown').on('click', function (e) {
            e.stopPropagation();
            $(this).toggleClass('open');
            $(this).find('.dropdown-toggle').attr('aria-expanded', $(this).hasClass('open'));
        });
        $(document).on('click', function (e) {
            if (!$(e.target).closest('.dropdown').length) {
                $('.dropdown').removeClass('open');
                $('.dropdown-toggle').attr('aria-expanded', 'false');
            }
        });
    });

    // If user does not login already, load cart in local storage
    // Else call $cartController above
    // If user is logged in, display server-side cart
    const isUserLoggedIn = <?= isset($_SESSION['uid']) ? 'true' : 'false' ?>;
    if (!isUserLoggedIn) {
        // User is not logged in, load cart from localStorage
        loadLocalStorageCart();
    }

    function loadLocalStorageCart() {
        let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
        let totalPrice = 0;

        if (cartItems.length > 0) {
            let requests = cartItems.map(item => {
                return $.ajax({
                    url: '/store',
                    method: 'GET',
                    data: { cart_pid: item.pid },
                    dataType: 'json'
                });
            });

            $.when.apply($, requests).done(function (...responses) {
                responses = responses.map(res => res[0]); // Extract data from each response

                responses.forEach((product, index) => {
                    const item = cartItems[index];
                    const productTotalPrice = item.qty * product.product_price;
                    totalPrice += productTotalPrice;

                    $('#cart_product').append(`
                        <div class="product-widget" onclick="window.location.href='/store?product_id=${product.product_id}'">
                            <div class="product-img"s>
                                <img src="public/product_images/${product.product_image}" alt="${(product.product_title)}">
                            </div>
                            <div class="product-body">
                                <h3 class="product-name">
                                    <a href="/store?product_id=${product.product_id}">${(product.product_title)}</a>
                                </h3>
                                <h4 class="product-price">
                                    <span class="qty">${item.qty}</span> x $${Math.round(product.product_price)}
                                </h4>
                            </div>
                        </div>
                    `);
                });

                // Update total cart price and item count
                $('#cartItemCount').text(cartItems.length);
                $('#cart_product').append(`
                    <small class="qty">${cartItems.length} Item(s) in cart</small>
                    <h5>Total price: $${Math.round(totalPrice)}</h5>
                `);
            }).fail(function () {
                console.error('Failed to fetch product details from the server.');
                $('#cart_product').html('<div class="alert alert-warning m-auto" role="alert">Failed to load cart items.</div>');
            });
        } else {
            $('#cart_product').html('<div class="alert alert-warning m-auto" role="alert">Your cart is empty.</div>');
            $('#cartItemCount').text('0');
        }
    }


</script>