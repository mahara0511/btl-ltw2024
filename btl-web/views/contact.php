    <?php include ROOT_PATH."/views/layouts/header.php"; ?> 

    <link type="text/css" rel="stylesheet" href="public/css/contact.css"/>
    <link type="text/css" rel="stylesheet" href="public/css/aboutUs.css"/>
    
    <div class="bigwrapper">

        <div class="contact-heading">
            <h1>Contact Us</h1>
            <h3>Have a question, concern, or feedback? Our team is ready to assist you.</h3>
            <h3>We're here to help!</h3>
        </div>
    
        <h2 class="contact-form-title" style="text-align:center">Get in Touch with Us</h2>
        <h3 style="text-align:center">Fill out the form below, and we'll get back to you within 24-48 hours.</h3>
        <div class="container contact-form-content">
            <div class="col-md-6">
                <form method="post" class="support-form">
                    <br><br>
                    <div class="col-md-6">
                        <label for="fname">First Name: <span class="red-txt">*</span></label><br>
                        <input type="text" id="fname" name="fname" required>
                        <p><br></p>
                    </div>

                    <div class="col-md-6">
                        <label for="lname">Last Name: <span class="red-txt">*</span></label><br>
                        <input type="text" id="lname" name="lname" required>
                        <p><br></p>
                    </div>

                    <div class="col-md-6">
                        <label for="email">Email: <span class="red-txt">*</span></label><br>
                        <input type="email" id="email" name="email" required>
                        <p><br></p>
                    </div>

                    <div class="col-md-6">
                        <label for="phone">Phone Number: <span class="red-txt">*</span></label><br>
                        <input type="text" id="phone" name="phone" required>
                        <p><br></p>
                    </div>

                    <div class="col-md-12">
                        <label for="sbj">Subject: <span class="red-txt">*</span></label><br>
                        <input type="text" id="sbj" name="sbj" style="width: 100%;" required>
                        <p><br></p>
                    </div>
                    
                    <div class="col-md-12">
                        <label for="message">How we might help you? <span class="red-txt">*</span></label><br>
                        <textarea id="message" name="message" rows="5" style="width: 100%;" required></textarea>
                        <p><br></p>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="contact-submit-btn">Submit</button>
                        <p><br></p>
                    </div>
                </form>
            </div>

            <div class="col-md-6" style="text-align: center;">
                <p><br></p>
                <h3>"We Value Your Feedback!"</h3>
                <img src="/public/img/customer-support.png" alt="Customer Support Image" style="width: 100%;">
                <p><br></p>
            </div>
        </div>
    </div>
    <?php include ROOT_PATH."/views/layouts/footer.php"; ?>

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
        function menu(){
            if(c % 2 == 0) {
                document.querySelector('.cont_drobpdown_menu').className = "cont_drobpdown_menu active";    
                document.querySelector('.cont_icon_trg').className = "cont_icon_trg active";    
                c++; 
            } else{
                document.querySelector('.cont_drobpdown_menu').className = "cont_drobpdown_menu disable";        
                document.querySelector('.cont_icon_trg').className = "cont_icon_trg disable";        
                c++;
            }
        }
    </script>
    <script type="text/javascript">
        $('.block2-btn-addcart').each(function(){
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to cart !", "success");
            });
        });

        $('.block2-btn-addwishlist').each(function() {
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to wishlist !", "success");
            });
        });
    </script>
</body>
</html>
