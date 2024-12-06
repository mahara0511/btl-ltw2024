<?php
require_once ROOT_PATH . "/views/layouts/header.php";
?>

<?php
$cart_items = $data['cart_items'] ?? [];
$total_price = $data['total_price'] ?? 0;
?>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript" src="public/js/cart.js"></script>




<section class="section">
    <!-- Modal -->
    <div class="modal fade" id="Modal_alert" tabindex="-1" role="dialog" aria-labelledby="ModalAlertLabel"
        aria-hidden="true" style="height: 500px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="ModalAlertLabel">Alert</h5>
                </div>
                <div class="modal-body">
                    <p id="modal_message">Your cart has been updated successfully!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div id="cart_checkout">
            <div class="main">
                <div class="table-responsive">
                    <form method="post" action="checkout.php">
                        <table id="cart" class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th style="width:50%" class="text-center">Product</th>
                                    <th style="width:15%" class="text-center">Price</th>
                                    <th style="width:5%" class="text-center">Quantity</th>
                                    <th style="width:25%" class="text-center">Subtotal</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($cart_items)): ?>
                                    <?php foreach ($cart_items as $item): ?>
                                        <tr>
                                            <td data-th="Product">
                                                <div class="row">
                                                    <a href="index.php?product_id=<?= $item['product_id']; ?>">
                                                        <div class="col-sm-4 text-center">
                                                            <img src="<?= 'product_images/' . htmlspecialchars($item['product_image']); ?>"
                                                                style="height: 70px; width: 75px;" alt="Product Image" />
                                                            <div
                                                                class=" nomargin product-name header-cart-item-name text-center text-uppercase fs-6">

                                                                <?= htmlspecialchars($item['product_title']); ?>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="col-sm-8">
                                                        <p
                                                            style="width: 100%; height: 100px; margin-top: 12px; margin-top: 10px; overflow-Y:auto;">
                                                            <?= htmlspecialchars($item['description'] ?? 'No description available.'); ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <input type="hidden" name="product_id[]" value=<?php echo "'" . $item['product_id'] . "'"; ?> />
                                            <input type="hidden" name="" value=<?php echo "'" . $item['id'] . "'"; ?> />
                                            <td data-th="Price">
                                                <input type="text" class="form-control price text-center"
                                                    value="$<?= $item['product_price']; ?>" readonly="readonly">
                                            </td>
                                            <td data-th="Quantity">
                                                <input type="number" class="form-control qty" name="qty[]"
                                                    value="<?= $item['qty']; ?>" min="1">
                                            </td>
                                            <td data-th="Subtotal" class="text-center">
                                                $<?= $item['qty'] * $item['product_price']; ?>
                                            </td>
                                            <td class="actions" data-th="">
                                                <div class="btn-group">
                                                    <a class="btn btn-info btn-sm update"
                                                        update_id="<?= $item['product_id']; ?>">
                                                        <i class="fa fa-refresh"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm remove"
                                                        remove_id="<?= $item['product_id']; ?>">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Your cart is empty.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <a href="/" class="btn btn-warning">
                                            <i class="fa fa-angle-left"></i> Continue Shopping
                                        </a>
                                    </td>
                                    <td colspan="2" class="hidden-xs"></td>
                                    <td class="hidden-xs text-center">
                                        <b class="net_total">
                                            Total: $<?= $total_price ?>
                                        </b>
                                    </td>
                                    <td>
                                        <?php if (!isset($_SESSION['uid'])): ?>
                                            <a href="#" data-toggle="modal" data-target="#Modal_register"
                                                class="btn btn-success">
                                                Ready to Checkout
                                            </a>
                                        <?php elseif (isset($_SESSION["uid"])): ?>
                                            <input type="submit" name="checkout" class="btn btn-success" value="Checkout">
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>