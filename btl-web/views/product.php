<?php
require_once ROOT_PATH . "/views/layouts/header.php";
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


<!-- CSS for Comments Styling -->
<link rel="stylesheet" href="public/css/comments.css">


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
                        <img src=<?php echo "'public/product_images/" . $product_detail['product_image'] . "'" ?> alt=""
                            height="450px" style="transform: rotate(0deg);">
                    </div>
                </div>
            </div>

            <!-- Product Thumbnails -->
            <div class=" col-md-2 col-md-pull-5">
                <div id="product-imgs" class="slick-slider">
                    <div class="product-preview">
                        <img src=<?php echo "'public/product_images/" . $product_detail['product_image'] . "'" ?> alt=""
                            height="150px" style="transform: rotate(0deg);">
                    </div>

                    <div class="product-preview">
                        <img src=<?php echo "'public/product_images/" . $product_detail['product_image'] . "'" ?> alt=""
                            height="150px" style="transform: rotate(15deg);">
                    </div>

                    <div class="product-preview">
                        <img src=<?php echo "'public/product_images/" . $product_detail['product_image'] . "'" ?> alt=""
                            height="150px" style="transform: rotate(-15deg);">
                    </div>

                    <div class=" product-preview">
                        <img src=<?php echo "'public/product_images/" . $product_detail['product_image'] . "'" ?> alt=""
                            height="150px" style="transform: skewY(15deg) scale(0.9);">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
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
                            <?php echo "$" . round($product_detail['product_price']) ?>
                            <del class="product-old-price">
                                <?php echo "$" . round($product_detail['product_price'] * (100 + $product_detail['product_sale']) / 100) ?>
                            </del>
                        </h3>
                        <span class="product-available">In Stock</span>
                    </div>
                    <p style="margin: 20px auto; max-height: 200px; overflow-y: auto;">
                        <?php echo $product_detail['product_desc'] ?>

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

        <div class="row comments-section comments-div">
            <h3>Comments (<?php echo count($comments); ?>)</h3>

            <!-- Comments Display -->
            <div class="comments-list">
                <?php function displayComments($comments, $productId, $parentId = null, $indent = 0)
                {
                    // Define the maximum depth level
                    $maxDepth = 1;

                    // Count replies for depth 0 comments
                    $replyCounts = [];
                    if ($indent === 0) {
                        foreach ($comments as $comment) {
                            if ($comment['parent_id'] !== null) {
                                $rootCommentId = findRootCommentId($comments, $comment['parent_id']);
                                $replyCounts[$rootCommentId] = ($replyCounts[$rootCommentId] ?? 0) + 1;
                            }
                        }
                    }
                    ?>
                    <?php foreach ($comments as $comment): ?>
                        <?php if ($comment['parent_id'] === $parentId): ?>
                            <div class="comment" style="margin-left: <?php echo ($indent > $maxDepth ? 0 : 40); ?>px;">
                                <div class="comment-header">
                                    <span class="comment-user">
                                        <span style="margin-right: 10px;"><i class="fa-solid fa-user"></i></span>
                                        <?php echo $comment['commenter_first_name'] . ' ' . $comment['commenter_last_name']; ?>
                                        <?php if (!empty($comment['parent_id'])): ?>
                                            <i class="fa-solid fa-caret-right"></i>
                                            <span>
                                                @
                                                <?php echo $comment['parent_first_name'] . ' ' . $comment['parent_last_name']; ?>
                                            </span>
                                        <?php endif; ?>
                                    </span>
                                    <span class="comment-date">
                                        <i class="fa-regular fa-clock"></i>
                                        <?php echo $comment['cmt_date']; ?>
                                    </span>
                                </div>
                                <div class="comment-body">
                                    <?php echo htmlspecialchars($comment['content']); ?>
                                </div>

                                <div class="comment-actions">
                                    <div class="reply-group">
                                        <button class="reply-btn" data-comment-id="<?php echo $comment['cmt_id']; ?>"
                                            style="cursor: <?= isset($_SESSION['admin']) && $_SESSION['admin'] === true ? 'not-allowed' : 'pointer' ?>"
                                            <?= isset($_SESSION['admin']) && $_SESSION['admin'] === true ? 'disabled' : '' ?>>Reply</button>
                                        <?php if ($indent === 0): ?>
                                            <div class="comment-replies">
                                                <?php if (isset($replyCounts[$comment['cmt_id']]) && $replyCounts[$comment['cmt_id']] > 0): ?>
                                                    <button class="see-replies-btn" data-comment-id="<?php echo $comment['cmt_id']; ?>"
                                                        data-count-replies="<?php echo $replyCounts[$comment['cmt_id']]; ?>">
                                                        See replies (<?php echo $replyCounts[$comment['cmt_id']]; ?>)
                                                    </button>
                                                <?php else: ?>
                                                    <button class="no-replies">No replies</button>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <?php
                                    if (isset($_SESSION['admin']) && $_SESSION['admin'] === true || (isset($_SESSION['uid']) && $_SESSION['uid'] == $comment['user_id'])):
                                        // if ($comment['user_id'] == 1):
                                        ?>
                                        <div class="dropdown">
                                            <button class="dropdown-toggle" type="button">
                                                <i class="fa-solid fa-gear"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <button class="edit-comment" data-comment-id="<?php echo $comment['cmt_id']; ?>">
                                                    <i class="fa-solid fa-edit"></i> Edit
                                                </button>
                                                <button class="delete-comment" data-comment-id="<?php echo $comment['cmt_id']; ?>">
                                                    <i class="fa-solid fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Nested Replies (initially hidden for depth 0) -->
                                <div class="nested-replies" id="nested-replies-<?php echo $comment['cmt_id']; ?>"
                                    style="display:<?php echo ($indent == 0 ? 'none' : 'display'); ?>; <?php echo ($indent == 0 ? 'max-height: 50vh; overflow-y: auto' : ''); ?>">

                                    <?php if ($indent > 0): ?>
                                        <!-- Reply Form (Hidden by default) -->
                                        <div class="reply-form" id="reply-form-<?php echo $comment['cmt_id']; ?>" style="display:none;">
                                            <div class="reply-to">
                                                <p>
                                                    Reply to @
                                                    <?= $comment['commenter_first_name'] . ' ' . $comment['commenter_last_name']; ?>
                                                </p>
                                                <button class="close-reply-btn">&times;</button>
                                            </div>
                                            <form class="reply-form-submit" data-comment-id="<?php echo $comment['cmt_id']; ?>">
                                                <span class="comment-message"></span>
                                                <input type="hidden" name="parent_id" value="<?php echo $comment['cmt_id']; ?>">
                                                <input type="hidden" name="p_id" value="<?php echo $productId; ?>">
                                                <textarea name="content" placeholder="Write a reply..." required></textarea>
                                                <button class="btn btn-primary" type="submit">Post Reply</button>
                                            </form>
                                        </div>
                                    <?php endif ?>
                                    <?php displayComments($comments, $productId, $comment['cmt_id'], $indent + 1); ?>
                                </div>

                                <?php if ($indent === 0): ?>
                                    <!-- Reply Form (Hidden by default) -->
                                    <div class="reply-form" id="reply-form-<?php echo $comment['cmt_id']; ?>" style="display:none;">
                                        <div class="reply-to">
                                            <p>
                                                Reply to @
                                                <?= $comment['commenter_first_name'] . ' ' . $comment['commenter_last_name']; ?>
                                            </p>
                                            <button class="close-reply-btn">&times;</button>
                                        </div>
                                        <form class="reply-form-submit" data-comment-id="<?php echo $comment['cmt_id']; ?>">
                                            <span class="comment-message"></span>
                                            <input type="hidden" name="parent_id" value="<?php echo $comment['cmt_id']; ?>">
                                            <input type="hidden" name="p_id" value="<?php echo $productId; ?>">
                                            <textarea name="content" placeholder="Write a reply..." required></textarea>
                                            <button class="btn btn-primary" type="submit">Post Reply</button>
                                        </form>
                                    </div>
                                <?php endif ?>


                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php } ?>

                <?php
                // Helper function to find the root comment ID
                function findRootCommentId($comments, $parentId)
                {
                    foreach ($comments as $comment) {
                        if ($comment['cmt_id'] === $parentId) {
                            return $comment['parent_id'] === null ? $parentId : findRootCommentId($comments, $comment['parent_id']);
                        }
                    }
                    return null;
                }

                // Use the product ID from the existing PHP code
                $productId = $product_detail['product_id'];
                displayComments($comments, $productId);
                ?>
            </div>

            <!-- New Comment Form -->
            <div class="new-comment-form">
                <h4>Add your new comment</h4>
                <span class="comment-message"></span>
                <form>
                    <input type="hidden" name="p_id" value="<?php echo $product_detail['product_id']; ?>">
                    <textarea name="content" placeholder="Write your comment..." required></textarea>
                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>
            </div>

            <!-- /Comments -->

        </div>
        <!-- /container -->
    </div>
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
                    $new_price = round($related_product['product_price']);
                    $sale = $related_product['product_sale'];
                    $old_price = $new_price * (100 + $sale) / 100;
                    ?>
                    <div class='col-md-3 col-xs-6 w-100'>
                        <div class='product'>
                            <a href=<?php echo "'store?product_id=" . $related_product['product_id'] . "'" ?>>
                                <div class='product-img'>
                                    <img src=<?php echo "'public/product_images/" . $related_product['product_image'] . "'" ?>
                                        alt=<?php echo "'" . $related_product['product_title'] . "'" ?>>
                                    <div class='product-label'>
                                        <span class='sale'><?php echo $sale . "%" ?></span>
                                        <span class='new'>NEW</span>
                                    </div>
                                </div>
                            </a>
                            <div class='product-body'>
                                <p class='product-category'><?php echo $related_product['cat_title']; ?></p>
                                <div class='product-name header-cart-item-name'>
                                    <a href=<?php echo "'store?product_id=" . $related_product['product_id'] . "'" ?>>
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
require_once ROOT_PATH . "/views/layouts/footer.php";
?>