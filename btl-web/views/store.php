<h1>Product List</h1>


<div class="main main-raised">

    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <!-- aside Widget -->
                    <div id="get_category">
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Price</h3>
                        <div class="price-filter">
                            <div id="price-slider" class="noUi-target noUi-ltr noUi-horizontal">
                                <div class="noUi-base">
                                    <div class="noUi-origin" style="left: 0%;">
                                        <div class="noUi-handle noUi-handle-lower" data-handle="0" tabindex="0"
                                            role="slider" aria-orientation="horizontal" aria-valuemin="0.0"
                                            aria-valuemax="100.0" aria-valuenow="0.0" aria-valuetext="1.00"
                                            style="z-index: 5;"></div>
                                    </div>
                                    <div class="noUi-connect" style="left: 0%; right: 0%;"></div>
                                    <div class="noUi-origin" style="left: 100%;">
                                        <div class="noUi-handle noUi-handle-upper" data-handle="1" tabindex="0"
                                            role="slider" aria-orientation="horizontal" aria-valuemin="0.0"
                                            aria-valuemax="100.0" aria-valuenow="100.0" aria-valuetext="999.00"
                                            style="z-index: 4;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-number price-min">
                                <input id="price-min" type="number">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                            <span>-</span>
                            <div class="input-number price-max">
                                <input id="price-max" type="number">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                        </div>
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div id="get_brand">
                        <div class='aside'>
                            <h3 class='aside-title'>Brand</h3>
                            <div class='btn-group-vertical'>
                                <?php foreach ($brands as $brand): ?>
                                    <div type='button' class='btn navbar-btn selectBrand' bid=<?php echo "'" . $brand['brand_id'] . "'"; ?>>
                                        <a href='#'>
                                            <span></span>
                                            <?php echo $brand['brand_title']; ?>
                                            <small><?php echo "(" . $brand['count_items'] . ")"; ?></small>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Top selling</h3>
                        <div id="get_product_home">
                            <!-- product widget -->
                            <?php foreach ($top_products as $product): ?>
                                <div class='product-widget'>
                                    <a href=<?php "'product.php?p=" . $product['product_id'] . "'" ?>>
                                        <div class='product-img'>
                                            <img src=<?php echo "'product_images/" . $product['product_image'] . "'" ?>
                                                alt=''>
                                        </div>
                                        <div class='product-body'>
                                            <p class='product-category'><?php echo $product['cat_title']; ?></p>
                                            <h3 class='product-name'><a href=<?php "'product.php?p=" . $product['product_id'] . "'" ?>><?php echo $product['product_title'] ?></a></h3>
                                            <h4 class='product-price'><?php echo $product['product_price'] ?><del
                                                    class='product-old-price'>$990.00</del>
                                            </h4>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>

                            <!-- product widget -->
                        </div>
                    </div>
                    <!-- /aside Widget -->
                </div>
                <!-- /ASIDE -->

                <!-- STORE -->
                <div id="store" class="col-md-9">
                    <!-- store top filter -->
                    <div class="store-filter clearfix">
                        <div class="store-sort">
                            <label>
                                Sort By:
                                <select class="input-select">
                                    <option value="0">Popular</option>
                                    <option value="1">Position</option>
                                </select>
                            </label>

                            <label>
                                Show:
                                <select class="input-select">
                                    <option value="0">20</option>
                                    <option value="1">50</option>
                                </select>
                            </label>
                        </div>
                        <ul class="store-grid">
                            <li class="active"><i class="fa fa-th"></i></li>
                            <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                        </ul>
                    </div>
                    <!-- /store top filter -->

                    <!-- store products -->
                    <div class="row" id="product-row">
                        <div class="col-md-12 col-xs-12" id="product_msg">
                        </div>
                        <!-- product -->
                        <div id="get_product">
                            <!--Here we get product jquery Ajax Request-->
                            <?php foreach ($products as $product): ?>
                                <!-- <li>
                                    <?php echo $product['product_title'] . " - " . $product['product_price'] . "$ - " . $product['product_desc']; ?>
                                </li> -->

                                <div class='col-md-4 col-xs-6'>
                                    <a href=<?php "'product.php?p=" . $product['product_id'] . "'" ?>>
                                        <div class='product'>
                                            <div class='product-img'>
                                                <img src=<?php echo "'product_images/" . $product['product_image'] . "'" ?>
                                                    style='max-height: 170px;' alt=''>
                                                <div class='product-label'>
                                                    <span class='sale'>-30%</span>
                                                    <span class='new'>NEW</span>
                                                </div>
                                            </div>
                                    </a>
                                    <div class='product-body'>
                                        <p class='product-category'><?php echo $product['cat_title']; ?></p>
                                        <h3 class='product-name header-cart-item-name'><a
                                                href='product.php?p=$pro_id'><?php echo $product['product_title'] ?></a>
                                        </h3>
                                        <h4 class='product-price header-cart-item-info'>
                                            <?php echo $product['product_price'] ?><del
                                                class='product-old-price'>$990.00</del>
                                        </h4>
                                        <div class='product-rating'>
                                            <i class='fa fa-star'></i>
                                            <i class='fa fa-star'></i>
                                            <i class='fa fa-star'></i>
                                            <i class='fa fa-star'></i>
                                            <i class='fa fa-star'></i>
                                        </div>
                                        <div class='product-btns'>
                                            <button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span
                                                    class='tooltipp'>add to wishlist</span></button>
                                            <button class='add-to-compare'><i class='fa fa-exchange'></i><span
                                                    class='tooltipp'>add to compare</span></button>
                                            <button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>quick
                                                    view</span></button>
                                        </div>
                                    </div>
                                    <div class='add-to-cart'>
                                        <button pid=<?php echo "\"" . $product['product_id'] . "\"" ?> id='product'
                                            class='add-to-cart-btn block2-btn-towishlist' href='#'><i
                                                class='fa fa-shopping-cart'></i> add to cart</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- /product -->
                </div>
                <!-- /store products -->

                <!-- store bottom filter -->
                <div class="store-filter clearfix">
                    <span class="store-qty">Showing 20-100 products</span>
                    <ul class="store-pagination" id="pageno">
                        <li><a class="active" href="#aside">1</a></li>

                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>
                <!-- /store bottom filter -->
            </div>
            <!-- /STORE -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
</div>