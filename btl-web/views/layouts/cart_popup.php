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

<div class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <i class="fa fa-shopping-cart"></i>
        <span>Your Cart</span>
        <div class="badge qty">0</div>
    </a>
    <div class="cart-dropdown">
        <div class="cart-list" id="cart_product">
        </div>
        <div class="cart-btns">
            <a href="cart.php" style="width:100%;"><i class="fa fa-edit"></i> edit cart</a>
        </div>
    </div>
</div>