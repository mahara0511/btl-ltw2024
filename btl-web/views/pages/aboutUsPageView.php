    <?php include ROOT_PATH."/views/layouts/header.php"; ?> 

    <link rel="stylesheet" href="public/css/aboutUsPage.css">
    <link rel="stylesheet" href="public/css/aboutUsresponsive.css">
    <link rel="stylesheet" href="public/fonts/themify-icons-font/themify-icons/themify-icons.css">
    <div class="bigwrapper">



            <!-- about section -->
            <div class="content-wrapper">
                <div id="band" class="content-section">
                    <h2 class="section-heading">ONLINE SHOPPING</h2>
                    <p class="section-sub-heading">Buy all the world</p>
                    <p class="about">
                        Shop from our extensive collection of high-quality products, carefully curated to meet your every need. Whether you’re looking for the latest gadgets, stylish apparel, or everyday essentials, we’ve got you covered.
                        Enjoy unbeatable prices, exclusive discounts, and fast, reliable shipping. At <strong>Online shopping</strong>, customer satisfaction is our top priority, which is why we offer secure payments and hassle-free returns for a seamless shopping experience.
                        <strong>Don’t miss out – explore our store now and grab your favorites before they’re gone!</strong>
                    </p>
                    <div class="member-list row">
                        <div class="text-center col col-three s-col-full mt-16">
                            <p class="member-name">John</p>
                            <img src="public/img/member-list/member1.jpg" alt="name" class="member-img">
                        </div>
    
                        <div class="text-center col col-three s-col-full mt-16">
                            <p class="member-name">Sarah</p>
                            <img src="public/img/member-list/member1.jpg" alt="name" class="member-img">
                        </div>
    
                        <div class="text-center col col-three s-col-full mt-16">
                            <p class="member-name">Mike</p>
                            <img src="public/img/member-list/member1.jpg" alt="name" class="member-img">
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            

            <!-- tour section -->
            <div id="tour" class="tour-section">
                <div class="content-section">
                    <h2 class="section-heading">LOCAL STORE</h2>
                    <p class="section-sub-heading">You can buy all what you want!</p>
                    <ul class="ticket-list">
                        <li>New York<span class="sold-out">Comming soon</span></li>
                        <li>Florida<span class="sold-out">Comming soon</span></li>
                        <li>Ohio<span class="quantity">3</span></li>
                    </ul>
                    
                    <div class="place-list row">
                        <div class="col col-three s-col-full mt-16">
                            <img src="public/img/place-list/place1.jpg" alt="New York" class="place-img">
                            <div class="place-infor">
                                <p class="place-heading">New York</p>
                                <div class="place-time">
                                    Opening: 6am - 10pm
                                </div>
                                <div class="place-desc">Praesent tincidunt sed tellus ut rutrum sed vitae justo.</div>
                                <button class="place-ticket-btn js-place-ticket-btn s-full-width ">See Map</button>
                            </div>
                        </div>
   
                        <div class="col col-three s-col-full mt-16">
                            <img src="public/img/place-list/place2.jpg" alt="New York" class="place-img">
                            <div class="place-infor">
                                <p class="place-heading">Florida</p>
                                <div class="place-time">Opening: 7am - 9pm</div>
                                <div class="place-desc">Praesent tincidunt sed tellus ut rutrum sed vitae justo.</div>
                                <button class="place-ticket-btn js-place-ticket-btn s-full-width ">See Map</button>
                            </div>
                        </div>
                        
                        <div class="col col-three s-col-full mt-16">
                            <img src="public/img/place-list/place3.jpg" alt="New York" class="place-img">
                            <div class="place-infor">
                                <p class="place-heading">Ohio</p>
                                <div class="place-time">Opening: 7am - 9pm</div>
                                <div class="place-desc">Praesent tincidunt sed tellus ut rutrum sed vitae justo.</div>
                                <button class="place-ticket-btn js-place-ticket-btn s-full-width ">See Map</button>
                            </div>
                        </div>

                        <div class="clear"></div>
                    </div>
            
                <div class="modal js-modal">
                    <div class="modal-container">
                        <div class="modal-close js-modal-close">
                            <i class="close-btn ti-close"></i>
                            
                        </div>
                        <div class="clear"></div>
                        <header class="modal-header">
                            <i class="modal-bag-icon ti-bag"></i>
                            Tickets
                        </header>

                        <div class="modal-body">
                            <label for="modal-input-number-ticket" class="modal-label-input">
                                <i class="cart-icon ti-shopping-cart"></i>
                                Tickets, $15 per person
                            </label>
                            <input type="text" id="modal-input-number-ticket" class="modal-input" placeholder="How many?">

                            <label for="modal-input-email" class="modal-label-input">
                                <i class="ti-user"></i>
                                Send To 
                            </label>
                            <input type="text" id="modal-input-email" class="modal-input" placeholder="Enter Email">

                            <button class="modal-pay-btn">
                                Pay <i class="ti-check"></i>
                            </button>
                        </div>

                        

                        <div class="modal-footer">
                            <p>Need <a href="#">help?</a></p>
                        </div>

                    </div>
                </div>
                    
                </div>
            </div>


            <!-- Begin image section -->
            <div class="image-section">
                <img src="public/img/map.jpg" class="tour-map" alt="">
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