var originProducts = []
var productsToFilter = []




$(document).ready(function () {
    // Toggle categories
    $(".toggle-category").on("click", function () {
        $(".category-list").slideToggle(500)
        $(".toggle-category i").toggleClass("fa-arrow-down fa-arrow-up")
    })

    // Toggle brands
    $(".toggle-brand").on("click", function () {
        $(".brand-list").slideToggle(500)
        $(".toggle-brand i").toggleClass("fa-arrow-down fa-arrow-up")
    })

    // Toggle get top sellings
    $(".toggle-get_product_home").on("click", function () {
        $("#get_product_home>.product-widget").slideToggle(500)
        $(".toggle-get_product_home i").toggleClass("fa-arrow-down fa-arrow-up")
    })

    
    // Handle category button click
    $(".category").click(function (event) {
        event.preventDefault(); // Prevent the default link behavior
        const categoryId = $(this).attr("cid");
        originProducts = []
        productsToFilter = []
        $.ajax({
            url: "index.php?action=view_category",
            method: "GET",
            data: { cid: categoryId },
            success: function (response) {
                // Update the store content with the response
                const newStoreContent = $(response).find("#store").html(); // Get the content of #store div from the response
                $("#store").html(newStoreContent); // Update only the store content
                // Optionally, update the URL to reflect the current category
                window.history.pushState(null, null, "index.php?cid=" + categoryId);
                applyPriceFillter();
            },
            error: function (xhr, status, error) {
                console.error("Error fetching category:", error);
            }
        });
    });

    // Handle category button click
    $(".selectBrand").click(function (event) {
        event.preventDefault(); // Prevent the default link behavior
        const brandId = $(this).attr("bid");
        originProducts = []
        productsToFilter = []
        $.ajax({
            url: "index.php?action=view_brand",
            method: "GET",
            data: { bid: brandId },
            success: function (response) {
                // Update the store content with the response
                const newStoreContent = $(response).find("#store").html(); // Get the content of #store div from the response
                $("#store").html(newStoreContent); // Update only the store content
                // Optionally, update the URL to reflect the current category
                window.history.pushState(null, null, "index.php?bid=" + brandId);
                applyPriceFillter();
            },
            error: function (xhr, status, error) {
                console.error("Error fetching category:", error);
            }
        });
    });

    applyPriceFillter();
})  

$(window).on("popstate", function () {
    let urlParams = new URLSearchParams(window.location.search);
    let categoryId = urlParams.get('cid');
    let brandId = urlParams.get('bid');

    // Determine which data to load based on URL parameters
    if (categoryId) {
        loadData("view_category", { cid: categoryId });
    } else if (brandId) {
        loadData("view_brand", { bid: brandId });
    } else {
        loadData("view"); // Default content
    }
});


// Load data function for category or brand
function loadData(action, params) {
    $.ajax({
        url: `index.php?action=${action}`,
        method: "GET",
        data: params,
        success: function (response) {
            const newStoreContent = $(response).find("#store").html();
            $("#store").html(newStoreContent);
        },
        error: function (xhr, status, error) {
            console.error(`Error fetching ${action}:`, error);
        }
    });
}


// Load the default content (e.g., all products)
function loadDefaultContent() {
    $.ajax({
        url: "index.php?action=view", // or whatever action loads the main store view
        method: "GET",
        success: function (response) {
            const newStoreContent = $(response).find("#store").html();
            $("#store").html(newStoreContent);
        },
        error: function (xhr, status, error) {
            console.error("Error fetching default content:", error);
        }
    });
}





function applyPriceFillter() {
    const priceSlider = document.getElementById("price-slider");
    const priceMinInput = document.getElementById("price-min");
    const priceMaxInput = document.getElementById("price-max");
    const productContainer = document.getElementById("get_product");
    const sortingSelect = document.querySelector(".store-sort-type select");
    
    // Desired range for the slider (e.g., 100,000 to 10,000,000)
    const minRange = 0;
    const maxRange = 50000;

    // Initialize noUiSlider
    if (priceSlider.noUiSlider) {
        priceSlider.noUiSlider.destroy();
        console.log("Existing slider destroyed");
    }
    noUiSlider.create(priceSlider, {
        start: [minRange, maxRange/2], // Initial slider values
        connect: true, // Connect the handles
        range: {
            min: minRange,
            max: maxRange,
        },
        step: 100,
        // tooltips: [true, true], 
        format: {
            to: value => Math.round(value),
            from: value => Number(value)
        }
    });

    // Function to update transform of noUi-origin elements
    function updateSliderOriginTransform() {
        // Get all noUi-origin elements (they represent the handles)
        const origins = document.querySelectorAll('.noUi-origin');
        origins.forEach((origin, index) => {
            // Get the current value of the slider handle
            const currentValue = priceSlider.noUiSlider.get()[index]; // Get the current value of the slider handle
            const percentageValue = (currentValue - minRange) / (maxRange - minRange) * 100; // Calculate percentage for x position

            // Update the transform style of the noUi-origin to move it horizontally
            origin.style.transform = `translate(${percentageValue}%, 0px)`; // Move it by 100% of the x-axis
        });
    }

    // Update slider on input change
    function updateSlider() {
        priceSlider.noUiSlider.set([priceMinInput.value, priceMaxInput.value]);
    }

    // Helper function to filter and sort products
    function filterAndSortProducts() {
        const minPrice = parseFloat(priceMinInput.value) || minRange;
        const maxPrice = parseFloat(priceMaxInput.value) || maxRange;
        const sortType = sortingSelect.value;

        if(originProducts.length === 0) {
            productsToFilter = Array.from(productContainer.querySelectorAll(".product"));
            originProducts = productsToFilter
        }
        productsToFilter = originProducts

        // Filter products by price range
        const filteredProducts = productsToFilter.filter(product => {
            const price = parseFloat(
                product.querySelector(".product-price").textContent.replace("$", "")
            );
            return price >= minPrice && price <= maxPrice;
        });

        // Sort products based on the selected criteria
        filteredProducts.sort((a, b) => {
            const priceA = parseFloat(a.querySelector(".product-price").textContent.replace("$", ""));
            const priceB = parseFloat(b.querySelector(".product-price").textContent.replace("$", ""));
            const discountA = parseInt(a.querySelector(".sale").textContent.replace("%", ""));
            const discountB = parseInt(b.querySelector(".sale").textContent.replace("%", ""));

             if (sortType === "Expensive") {
                if (priceB == priceA)
                    return discountB - discountA // Descending by discount
                return priceB - priceA; // Descending by price
            } else if (sortType === "Cheap") {
                if (priceB == priceA)
                    return discountB - discountA // Descending by discount
                return priceA - priceB; // Ascending by price
            } else if (sortType === "Discount") {
                if (discountB == discountA)
                    return priceB - priceA; // Descending by price
                return discountB - discountA; // Descending by discount
            }
        });

        // Update the container with the filtered and sorted products
        productContainer.innerHTML = `
            ${filteredProducts.map(product => `<div class='col-md-4 col-xs-6'> ${product.outerHTML} </div>` ).join("")}
        `;
    }

    // Update inputs on slider change
    priceSlider.noUiSlider.on("update", function (values) {
        priceMinInput.value = values[0];
        priceMaxInput.value = values[1];
        updateSliderOriginTransform();
        filterAndSortProducts();
    });
    
    // Event: Update slider on input change
    priceMinInput.addEventListener("change", function () {
        updateSlider();
        filterAndSortProducts();
    });
    priceMaxInput.addEventListener("change", function () {
        updateSlider();
        filterAndSortProducts();
    });

    // Event: Sorting dropdown change
    sortingSelect.addEventListener("change", filterAndSortProducts);

    // Event: Increase/Decrease inputs
    document.querySelectorAll(".qty-up").forEach(btn => {
        btn.addEventListener("click", function () {
            const input = this.parentNode.querySelector("input");
            input.value = parseInt(input.value) + 500;
            updateSlider();
            filterAndSortProducts();
        });
    });

    document.querySelectorAll(".qty-down").forEach(btn => {
        btn.addEventListener("click", function () {
            const input = this.parentNode.querySelector("input");
            input.value = Math.max(0, parseInt(input.value) - 100); // Ensure non-negative
            updateSlider();
            filterAndSortProducts();
        });
    });
}