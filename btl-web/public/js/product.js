document.addEventListener("DOMContentLoaded", function () {
    // Flex slider for product images
    // Initialize Slick for thumbnails
    $('#product-imgs').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        centerMode: true,
        focusOnSelect: true,
        centerPadding: 0,
        vertical: true,
        responsive: [
            {
                breakpoint: 991,
                settings:
                    {
                        vertical: false,
                        arrows: false,
                        dots: true,
                    }
            },
        ]
    });

    // Handle arrow clicks to update the main image
    $('#product-imgs').on('click', function () {
        const mainImage = document.querySelector("#product-main-img img");
        const thumbnailImage = document.querySelector("#product-imgs .slick-current img");
        mainImage.src = thumbnailImage.src; // Update the main image source
        mainImage.style.transform = thumbnailImage.style.transform; // Apply the transform style
    });
    // Handle dot clicks in responsive mode
    $('#product-imgs').on('click', function () {
        const mainImage = document.querySelector("#product-main-img img");
        const thumbnailImage = document.querySelector("#product-imgs .slick-current img");
        mainImage.src = thumbnailImage.src; // Update the main image source
        mainImage.style.transform = thumbnailImage.style.transform; // Apply the transform style
    });
    // Handle slider drag or slide change to update the main image
    $('#product-imgs').on('afterChange', function () {
        const mainImage = document.querySelector("#product-main-img img");
        const thumbnailImage = document.querySelector("#product-imgs .slick-current img")
        mainImage.src = thumbnailImage.src; // Update the main image source
        mainImage.style.transform = thumbnailImage.style.transform; // Apply the transform style
    });

    
    // Handle quantity input
    const quantityInput = document.getElementById("quantity-input");
    document.querySelector(".qty-down").addEventListener("click", () => {
        if (quantityInput.value > 1) {
            quantityInput.value--;
        }
    });
    document.querySelector(".qty-up").addEventListener("click", () => {
        quantityInput.value++;
    });


    // Handle add-to-cart functionality
    const addToCartBtn = document.querySelector(".btn-group .add-to-cart-btn#product");
    addToCartBtn.addEventListener("click", () => {
        const product = {
            id: addToCartBtn.getAttribute("pid"),
            title: document.querySelector(".product-name").innerText,
            price: parseFloat(
                document.querySelector(".product-price").textContent.replace("$", "")
            ),
            quantity: parseInt(quantityInput.value),
        };

        console.log(product)

        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const existingProductIndex = cart.findIndex((item) => item.id === product.id);

        if (existingProductIndex > -1) {
            cart[existingProductIndex].quantity += product.quantity;
        } else {
            cart.push(product);
        }

        localStorage.setItem("cart", JSON.stringify(cart));
        alert("Product added to cart!");
    });
});