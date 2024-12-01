<?php
// include 'layouts/header.php';
?>

<?php
$_SESSION['product_id'] = $product_detail['product_id'];
?>

<!-- SLICK -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="public/js/product.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<!-- Modal -->
<div class="modal fade" id="Modal_alert" tabindex="-1" role="dialog" aria-labelledby="ModalAlertLabel"
    aria-hidden="true" style="height: 500px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="ModalAlertLabel">Notification</h5>
            </div>
            <div class="modal-body">
                <p id="modal_message">Product has been added to cart successfully!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<!-- SECTION -->
<div class="section main main-raised">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Product main img -->
            <div class="col-md-5 col-md-push-2">
                <div id="product-main-img">
                    <div class="product-preview">
                        <img src=<?php echo "'product_images/" . $product_detail['product_image'] . "'" ?> alt=""
                            style="transform: rotate(0deg);">
                    </div>
                </div>
            </div>

            <!-- Product Thumbnails -->
            <div class=" col-md-2 col-md-pull-5">
                <div id="product-imgs" class="slick-slider">
                    <div class="product-preview">
                        <img src=<?php echo "'product_images/" . $product_detail['product_image'] . "'" ?> alt=""
                            style="transform: rotate(0deg);">
                    </div>

                    <div class="product-preview">
                        <img src=<?php echo "'product_images/" . $product_detail['product_image'] . "'" ?> alt=""
                            style="transform: rotate(15deg);">
                    </div>

                    <div class="product-preview">
                        <img src=<?php echo "'product_images/" . $product_detail['product_image'] . "'" ?> alt=""
                            style="transform: rotate(-15deg);">
                    </div>

                    <div class=" product-preview">
                        <img src=<?php echo "'product_images/" . $product_detail['product_image'] . "'" ?> alt=""
                            style="transform: skewY(15deg) scale(0.9);">
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="product-details">
                    <h2 class="product-name"><?php echo $product_detail['product_title'] ?></h2>
                    <div>
                        <div class="product-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <!-- <a class="review-link" href="#review-form">10 Review(s) | Add your review</a> -->
                    </div>
                    <div>
                        <h3 class="product-price">
                            <?php echo "$" . $product_detail['product_price'] ?>
                            <del class="product-old-price">
                                <?php echo "$" . $product_detail['product_price'] * (100 + $product_detail['sale']) / 100 ?>
                            </del>
                        </h3>
                        <span class="product-available">In Stock</span>
                    </div>
                    <p style="margin: 20px auto; max-height: 200px; overflow-y: auto;">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                        incididunt ut

                    </p>


                    <div class="add-to-cart">
                        <div class="qty-label">
                            Quantity:
                            <div class="input-number">
                                <input id="quantity-input" type="number" value="1">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                        </div>
                        <div class="btn-group">
                            <button class="add-to-cart-btn" pid=<?php echo "'" . $product_detail['product_id'] . "'" ?>
                                id="product">
                                <i class="fa fa-shopping-cart"></i>
                                add to cart
                            </button>
                        </div>

                    </div>

                    <!-- <ul class="product-btns">
                        <li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
                    </ul> -->

                    <ul class="product-links">
                        <li>Category:</li>
                        <li>
                            <a href=<?php echo "'index.php?action=view_category&cid=" . $product_detail['cat_id'] . "'" ?>>
                                <?php echo $product_detail['category'] ?>
                            </a>
                        </li>
                    </ul>

                    <ul class="product-links">
                        <li>Share:</li>
                        <li>
                            <a href="https://www.facebook.com">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                        </li>
                        <!-- <li><a href="#"><i class="fa fa-twitter"></i></a></li> -->
                        <li>
                            <a href="https://www.messenger.com">
                                <i class="fa-brands fa-facebook-messenger"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.gmail.com">
                                <i class="fa-solid fa-envelope"></i>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>


            <!-- /Product main img -->

            <!-- Product thumb imgs -->

            <!-- /Product thumb imgs -->

            <!-- Product details -->

            <!-- /Product details -->

            <!-- Product tab -->

            <!-- /product tab -->

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section main main-raised">
    <!-- container -->
    <div class="container" style="margin-bottom: 50px !important;">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3 class="title">Related Products</h3>
                </div>
            </div>
            <?php if (!isset($related_products) || empty($related_products)): ?>
                <div class='col-sm-12'>
                    <div class="alert alert-danger m-auto text-center w-100" role="alert">
                        Sorry... Our store currently has no related products
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($related_products as $related_product):
                    $new_price = $related_product['product_price'];
                    $related_product['sale'] = rand(0, 75);
                    $sale = $related_product['sale'];
                    $old_price = $new_price * (100 + $related_product['sale']) / 100;
                    ?>
                    <div class='col-md-3 col-xs-6 w-100'>
                        <div class='product'>
                            <a href=<?php echo "'index.php?product_id=" . $related_product['product_id'] . "'" ?>>
                                <div class='product-img'>
                                    <img src=<?php echo "'product_images/" . $related_product['product_image'] . "'" ?>
                                        alt=<?php echo "'" . $related_product['product_title'] . "'" ?>>
                                    <div class='product-label'>
                                        <span class='sale'><?php echo $related_product['sale'] . "%" ?></span>
                                        <span class='new'>NEW</span>
                                    </div>
                                </div>
                            </a>
                            <div class='product-body'>
                                <p class='product-category'><?php echo $related_product['cat_title']; ?></p>
                                <div class='product-name header-cart-item-name'>
                                    <a href=<?php echo "'index.php?product_id=" . $related_product['product_id'] . "'" ?>>
                                        <?php echo $related_product['product_title'] ?>
                                    </a>
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
                                <!-- <div class='product-btns'>
                                    <button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>add to
                                            wishlist</span></button>
                                    <button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to
                                            compare</span></button>
                                    <button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>quick
                                            view</span></button>
                                </div> -->
                            </div>
                            <div class='add-to-cart'>
                                <button pid=<?php echo "\"" . $related_product['product_id'] . "\"" ?> id='product'
                                    class='add-to-cart-btn block2-btn-towishlist' href='#'>
                                    <i class='fa fa-shopping-cart'></i> add to cart
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
        <!-- product -->

        <!-- /product -->

    </div>
    <!-- /row -->

</div>
<!-- /container -->





<!-- /Section -->

<!-- NEWSLETTER -->

<!-- /NEWSLETTER -->

<!-- FOOTER -->
<?php
// include "newslettter.php";
// include "footer.php";

?>