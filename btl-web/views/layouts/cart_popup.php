<!-- <style>
    .cart-popup {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
    }

    #cart-popup-btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
    }

    .cart-content {
        position: absolute;
        top: 40px;
        right: 0;
        background: white;
        border: 1px solid #ccc;
        padding: 10px;
        width: 300px;
    }

    .cart-content ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .cart-content li {
        border-bottom: 1px solid #ccc;
        padding: 5px 0;
    }

    .hidden {
        display: none;
    }
</style> -->

<!-- <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        const cartBtn = document.getElementById("cart-popup-btn");
        const cartContent = document.getElementById("cart-content");
        const cartCount = document.getElementById("cart-count");
        const cartItems = document.getElementById("cart-items");

        let cart = JSON.parse(localStorage.getItem("cart")) || [];

        // Toggle cart content visibility
        cartBtn.addEventListener("click", () => {
            cartContent.classList.toggle("hidden");
            displayCartItems();
        });

        // Update cart count
        function updateCartCount() {
            cartCount.textContent = cart.length;
        }

        // Display cart items
        function displayCartItems() {
            cartItems.innerHTML = ""; // Clear previous items
            cart.forEach((item, index) => {
                const li = document.createElement("li");
                li.innerHTML = `
                ${item.title} (x${item.quantity}) - $${item.price}
                <button data-index="${index}" class="remove-btn">Remove</button>
            `;
                cartItems.appendChild(li);
            });

            // Remove items from the cart
            document.querySelectorAll(".remove-btn").forEach(button => {
                button.addEventListener("click", (e) => {
                    const index = e.target.dataset.index;
                    cart.splice(index, 1);
                    saveCart();
                    updateCartCount();
                    displayCartItems();
                });
            });
        }

        // Save cart to localStorage
        function saveCart() {
            localStorage.setItem("cart", JSON.stringify(cart));
        }

        // Initialize cart count
        updateCartCount();
    });

</script> -->



<!-- <div class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <i class="fa fa-shopping-cart"></i>
        <span>Your Cart</span>
        <div class="badge qty">0</div>
    </a>
    <div class="cart-dropdown">
        <div class="cart-list" id="cart_product">
            <div class="product-widget">
                <div class="product-img">
                    <img src="product_images/' . $product_image . '" alt="">
                </div>
                <div class="product-body">
                    <h3 class="product-name"><a href="#">' . $product_title . '</a></h3>
                    <h4 class="product-price"><span class="qty">' . $n . '</span>$' . $product_price . '</h4>
                </div>
            </div>
            <div class="cart-summary">
                <small class="qty">' . $n . ' Item(s) selected</small>
                <h5>$' . $total_price . '</h5>
            </div>
        </div>
        <div class="cart-btns">
            <a href="cart.php" style="width:100%;"><i class="fa fa-edit"></i> edit cart</a>
        </div>
    </div>
</div> -->

<!-- <script src="https://unpkg.com/@popperjs/core@2"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script> -->

<script>
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
</script>


<?php
require_once(ROOT_PATH . '/controllers/CartController.php');
require(ROOT_PATH . '/config/db_connect.php');
$cartController = new CartController($conn);
?>


<div class="dropdown">
    <?php
    $cart_data = $cartController->view_cart_dropdown($_SERVER['REMOTE_ADDR'], $_SESSION['uid'] ?? null);
    $cart_items = $cart_data['cart_items'];
    $total_price = $cart_data['total_price'];
    ?>
    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <i class="fa fa-shopping-cart"></i>
        <span>Your Cart</span>
        <div class="badge qty">
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
                            <img src="<?= 'product_images/' . htmlspecialchars($item['product_image']); ?>"
                                alt="<?= htmlspecialchars($item['product_title']); ?>">
                        </div>
                        <div class="product-body">
                            <h3 class="product-name"><a
                                    href="/store?product_id=<?= $item['product_id'] ?>"><?= htmlspecialchars($item['product_title']); ?></a>
                            </h3>
                            <h4 class="product-price">
                                <span class="qty"><?= $item['qty']; ?></span> x $<?= $item['product_price']; ?>
                            </h4>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="cart-summary">
                    <small class="qty"><?= count($cart_items) . " Item(s) in cart" ?></small>
                    <h5>Total price : <?= "$ $total_price " ?></h5>
                </div>
            <?php else: ?>
                <div class="alert alert-warning m-auto " role="alert">
                    Your cart is empty.
                </div>
            <?php endif; ?>
        </div>
        <div class="cart-btns">
            <a href="/view_cart" style="width:100%;"><i class="fa fa-edit"></i> edit cart</a>
        </div>
    </div>
</div>