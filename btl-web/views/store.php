<?php
include 'layouts/header.php';
?>

<?php

// Handle actions
// if (isset($_GET['action'])) {
//     $action = $_GET['action'];
//     if ($action === 'view_category' && isset($_GET['cid'])) {
//         $storeController->view_category($_GET['cid']);
//     } elseif ($action === 'view_brand' && isset($_GET['bid'])) {
//         $storeController->view_brand($_GET['bid']);
//     } else {
//         $storeController->view();
//     }
// } else {
//     $storeController->view();
// }

?>

<script src="public/js/store.js"></script>

<div class="main main-raised">
    <div class="section">
        <!-- container -->
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <!-- aside Widget -->
                    <div id="get_category">
                        <div class='aside'>
                            <div class="aside-header-title toggle-category">
                                <h3 class='aside-title '>
                                    Categories
                                </h3>
                                <span>
                                    <i class="fa-solid fa-arrow-down"></i>
                                </span>
                            </div>
                            <div class='btn-group-vertical category-list' style="display:none;">
                                <?php foreach ($categories as $cat): ?>
                                    <div type='button' class='btn navbar-btn category' cid=<?php echo "'" . $cat['cat_id'] . "'"; ?>>
                                        <a href='#'>
                                            <span></span>
                                            <?php echo $cat['cat_title']; ?>
                                            <small class='qty'><?php echo "(" . $cat['count_items'] . ")"; ?></small>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div id="get_brand">
                        <div class='aside' style="margin-top: 12px;">
                            <div class="aside-header-title toggle-brand">
                                <h3 class='aside-title '>
                                    Brand
                                </h3>
                                <span>
                                    <i class="fa-solid fa-arrow-down"></i>
                                </span>
                            </div>
                            <div class='btn-group-vertical brand-list' style="display:none;">
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
                    <div class="aside" style="margin-top: 12px;">
                        <div class="aside-header-title">
                            <h3 class='aside-title'>
                                Price
                            </h3>
                        </div>
                        <div class="price-filter" style="margin-top: 12px;">
                            <div id="price-slider"></div>
                            <div class="price-slider-input">
                                <div class="input-number price-min">
                                    <input id="price-min" type="number" value="100000">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                                <span>
                                    <i class="fa-solid fa-left-right" style="width:10px; margin-right:4px;"></i>
                                </span>
                                <div class="input-number price-max">
                                    <input id="price-max" type="number" value="10000000">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside" style="margin-top: 20px;">
                        <div class="aside-header-title toggle-get_product_home">
                            <h3 class='aside-title '>
                                Top selling
                            </h3>
                            <span>
                                <i class="fa-solid fa-arrow-up"></i>
                            </span>
                        </div>
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
                                            <h3 class='product-name'>
                                                <a href=<?php "'product.php?p=" . $product['product_id'] . "'" ?>>
                                                    <?php echo $product['product_title'] ?>
                                                </a>
                                            </h3>
                                            <h4 class='product-price'>
                                                <?php echo "$" . $product['product_price'] ?>
                                                <del class='product-old-price'>$990.00</del>
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
                            <div class="store-sort-type">
                                <label>Sort By:</label>
                                <select class="input-select">
                                    <option value="Expensive">Expensive</option>
                                    <option value="Cheap">Cheap</option>
                                    <option value="Discount" selected>Biggest Discount</option>
                                </select>
                            </div>
                            <div class="store-sort-type">
                                <label>Show:</label>
                                <select class="input-select">
                                    <option value="10">10</option>
                                    <option value="20" selected>20</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                        </div>
                        <!-- <ul class="store-grid">
                            <li class="active"><i class="fa fa-th"></i></li>
                            <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                        </ul> -->
                    </div>
                    <!-- /store top filter -->

                    <!-- store products -->
                    <div class="row" id="product-row">
                        <div class="col-md-12 col-xs-12" id="product_msg">
                        </div>
                        <!-- product -->
                        <div id="get_product">
                            <!--Here we get product jquery Ajax Request-->

                            <?php foreach ($products as $product):
                                $new_price = $product['product_price'];
                                $product['sale'] = rand(0, 75);
                                $sale = $product['sale'];
                                $old_price = $new_price * (100 + $product['sale']) / 100;
                                ?>
                                <!-- <?php echo $product['product_title'] . " - " . $product['product_price'] . "$ - " . $product['product_desc']; ?> -->

                                <div class='col-md-4 col-xs-6'>
                                    <div class='product'>
                                        <a href=<?php "product.php?p=" . $product['product_id'] . "'" ?>>
                                            <div class='product-img'>
                                                <img src=<?php echo "'product_images/" . $product['product_image'] . "'" ?>
                                                    alt=<?php echo "'" . $product['product_title'] . "'" ?>>
                                                <div class='product-label'>
                                                    <span class='sale'><?php echo $sale . "%" ?></span>
                                                    <span class='new'>NEW</span>
                                                </div>
                                            </div>
                                        </a>
                                        <div class='product-body'>
                                            <p class='product-category'><?php echo $product['cat_title']; ?></p>
                                            <div class='product-name header-cart-item-name'>
                                                <a href='product.php?p=$pro_id'><?php echo $product['product_title'] ?></a>
                                            </div>
                                            <h4 class='product-price header-cart-item-info'>
                                                <?php echo "$" . $new_price ?>
                                                <del class='product-old-price'>
                                                    <?php echo "$" . $old_price; ?>
                                                </del>
                                            </h4>
                                            <div class='product-rating'>
                                                <i class='fa fa-star'></i>
                                                <i class='fa fa-star'></i>
                                                <i class='fa fa-star'></i>
                                                <i class='fa fa-star'></i>
                                                <i class='fa fa-star'></i>
                                            </div>
                                        </div>
                                        <div class='add-to-cart'>
                                            <button pid=<?php echo "\"" . $product['product_id'] . "\"" ?> id='product'
                                                class='add-to-cart-btn block2-btn-towishlist' href='#'>
                                                <i class='fa fa-shopping-cart'></i> add to cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- /product -->
                    <!-- /store products -->

                    <!-- store bottom filter -->
                    <div class="store-filter clearfix">
                        <!-- <span class="store-qty">Showing 20-100 products</span> -->
                        <ul class="store-pagination" id="pageno">
                            <li><a href="#"><i class="fa fa-angles-left"></i></a></li>
                            <li><a href="#aside">3</a></li>
                            <li><a class="active" href="#aside">4</a></li>
                            <li><a href="#aside">5</a></li>
                            <li><a href="#"><i class="fa fa-angles-right"></i></a></li>
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