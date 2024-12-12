<?php include ROOT_PATH . "/views/layouts/header.php"; ?>

<style>
    .error-container {
        height: 80vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: #333;
    }

    .error-code {
        font-size: 100px;
        font-weight: bold;
        color: #000;
        /* Tomato color */
    }

    .error-message {
        font-size: 40px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .error-description {
        font-size: 18px;
        color: #fff;
        margin-bottom: 30px;
    }

    .error-actions a {
        display: inline-block;
        padding: 15px 30px;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        color: #fff;
        background-color: #00b4db;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .error-actions a:hover {
        background-color: #0083b0;
    }
</style>

<div class="error-container">
    <div class="error-code">404</div>
    <div class="error-message">Page Not Found</div>
    <div class="error-description">
        Sorry, the page you are looking for doesn't exist or has been moved.
    </div>
    <div class="error-actions">
        <a href="/">Go Back to Home</a>
    </div>
</div>

<?php include ROOT_PATH . "/views/layouts/footer.php"; ?>


<script src="public/js/jquery.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<script src="public/js/slick.min.js"></script>
<script src="public/js/nouislider.min.js"></script>
<script src="public/js/jquery.zoom.min.js"></script>
<script src="public/js/sweetalert.min.js"></script>
<script src="public/js/jquery.payform.min.js" charset="utf-8"></script>
<script src="public/js/main.js"></script>
<script src="public/js/actions.js"></script>
<script src="public/js/script.js"></script>
<script>var c = 0;
    function menu() {
        if (c % 2 == 0) {
            document.querySelector('.cont_drobpdown_menu').className = "cont_drobpdown_menu active";
            document.querySelector('.cont_icon_trg').className = "cont_icon_trg active";
            c++;
        } else {
            document.querySelector('.cont_drobpdown_menu').className = "cont_drobpdown_menu disable";
            document.querySelector('.cont_icon_trg').className = "cont_icon_trg disable";
            c++;
        }
    }
</script>
<script type="text/javascript">
    $('.block2-btn-addcart').each(function () {
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', function () {
            swal(nameProduct, "is added to cart !", "success");
        });
    });

    $('.block2-btn-addwishlist').each(function () {
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', function () {
            swal(nameProduct, "is added to wishlist !", "success");
        });
    });
</script>
</body>

</html>