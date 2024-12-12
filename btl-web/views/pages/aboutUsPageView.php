<?php include ROOT_PATH . "/views/layouts/header.php"; ?>
<style>
    .map{
        width: fit-content;
        margin: auto;

        transition: all 0.1s linear;
        background: black;
    }
    .mapping{
        width: 800px;
        max-width: 100%;
    }
    #tour{
        padding-bottom:112px;
    }
    .form-control-clear {
        float: right;
        position: relative;
        top: 20px;
        right: 30px;
        transition: opacity 0.2s linear
        color: white;

    }
</style>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
                Shop from our extensive collection of high-quality products, carefully curated to meet your every need.
                Whether you’re looking for the latest gadgets, stylish apparel, or everyday essentials, we’ve got you
                covered.
                Enjoy unbeatable prices, exclusive discounts, and fast, reliable shipping. At <strong>Online
                    shopping</strong>, customer satisfaction is our top priority, which is why we offer secure payments
                and hassle-free returns for a seamless shopping experience.
                <strong>Don’t miss out – explore our store now and grab your favorites before they’re gone!</strong>
            </p>

            <div class="member-list row">
                <div class="text-center col col-three s-col-full mt-16">
                    <div class="card">
                        <img src="public/img/img_avatar3.png" alt="Khanh" style="width:100%">
                        <div class="wrapper">
                            <h2>Nguyen Minh Khanh</h2>
                            <p class="person-title">CEO & Founder</p>
                            <form action="contact_us" method="POST">
                                <input type="hidden" id="dummy" name="dummy" value="abcxyz">
                                <input type="hidden" id="name" name="name" value="Nguyen Minh Khanh">
                                <input type="hidden" id="email" name="email"
                                    value="khanh.nguyenminh0101@hcmut.edu.vn">
                                <input type="hidden" id="pos" name="pos" value="CEO & Founder">
                                <input type="hidden" id="img" name="img" value="img_avatar3.png">
                                <input type="hidden" id="about" name="about"
                                    value="Some text about Khanh lorem ipsum.">
                                <p><input type="submit" class="button" value="Contact"></p>
                            </form>
                            <!-- <p><button class="button" onclick="location.href = 'contact_us'">Contact</button></p> -->
                        </div>
                    </div>
                </div>
                
                <div class="text-center col col-three s-col-full mt-16">
                    <div class="card">
                        <img src="public/img/img_avatar3.png" alt="Tuan" style="width:100%">
                        <div class="wrapper">
                            <h2>Nguyen Truyen Tuan</h2>
                            <p class="person-title">Art Director</p>
                            <form action="contact_us" method="POST">
                                <input type="hidden" id="dummy" name="dummy" value="abcxyz">
                                <input type="hidden" id="name" name="name" value="Nguyen Truyen Tuan">
                                <input type="hidden" id="email" name="email"
                                    value="tuan.nguyenkhmtk22@hcmut.edu.vn">
                                <input type="hidden" id="pos" name="pos" value="Art Director">
                                <input type="hidden" id="img" name="img" value="img_avatar3.png">
                                <input type="hidden" id="about" name="about"
                                    value="Some text about Tuan lorem ipsum.">
                                <p><input type="submit" class="button" value="Contact"></p>
                            </form>

                        </div>
                        <div class="clear"></div>
                    </div>
                </div>

                <div class="text-center col col-three s-col-full mt-16">
                    <div class="card">
                        <img src="public/img/img_avatar3.png" alt="Anh" style="width:100%">
                        <div class="wrapper">
                            <h2>Tran Nhu Mai Anh</h2>
                            <p class="person-title">Designer</p>
                            <form action="contact_us" method="POST">
                                <input type="hidden" id="dummy" name="dummy" value="abcxyz">
                                <input type="hidden" id="name" name="name" value="Tran Nhu Mai Anh">
                                <input type="hidden" id="pos" name="pos" value="Designer">
                                <input type="hidden" id="img" name="img" value="img_avatar3.png">
                                <input type="hidden" id="about" name="about"
                                    value="Some text about Anh lorem ipsum.">
                                <input type="hidden" id="email" name="email" value="anh.tran2004@hcmut.edu.vn">
                                <p><input type="submit" class="button" value="Contact"></p>
                            </form>
                        </div>
                    </div>
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
                            <div class="place-desc">Praesent tincidunt sed tellus ut rutrum sed
                                vitae justo.</div>
                            <button class="place-ticket-btn js-place-ticket-btn s-full-width ">See
                                Map</button>
                        </div>
                    </div>

                    <div class="col col-three s-col-full mt-16">
                        <img src="public/img/place-list/place2.jpg" alt="New York" class="place-img">
                        <div class="place-infor">
                            <p class="place-heading">Florida</p>
                            <div class="place-time">Opening: 7am - 9pm</div>
                            <div class="place-desc">Praesent tincidunt sed tellus ut rutrum sed
                                vitae justo.</div>
                            <button class="place-ticket-btn js-place-ticket-btn s-full-width ">See
                                Map</button>
                        </div>

                    </div>

                    <div class="col col-three s-col-full mt-16">
                        <img src="public/img/place-list/place3.jpg" alt="New York" class="place-img">
                        <div class="place-infor">
                            <p class="place-heading">Ohio</p>
                            <div class="place-time">Opening: 7am - 9pm</div>
                            <div class="place-desc">Praesent tincidunt sed tellus ut rutrum sed
                                vitae justo.</div>
                            <button class="place-ticket-btn js-place-ticket-btn s-full-width ">See
                                Map</button>
                        </div>
                    </div>

                    <div class="clear"></div>
                </div>
            </div>


             <div class="clear"></div>
            <div class="map" ><iframe
                        class="mapping"
                        style="margin: auto"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387194.06243047205!2d-74.30933728043162!3d40.69701925911035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%20City%2C%20New%20York%2C%20USA!5e0!3m2!1sde!2s!4v1733964387216!5m2!1sde!2s"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <a class="form-control-clear" ><i class=" material-icons">clear</i></a>
            </div>

            <div class="clear"></div>


        </div>
            </div>

        </div>
    </div>


    <!-- Begin image section -->
    <div class="image-section">
        <img src="public/img/map.jpg" class="tour-map" alt="">
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

  $('.place-ticket-btn').click(  function() {
        var $this = $(this);
        if ( !$('.map').is( ":hidden" ) ) {
            $('.map').slideUp( "slow",  function() {
                console.log("jos");
                getVal($this.val());
                if ( $('.map').is( ":hidden" ) ) {
                    $('.map').slideDown( "slow");
                }
            });
        }
        else{
            getVal($this.val());
            if ( $('.map').is( ":hidden" ) ) {
                $('.map').slideDown( "slow");
            }
        }
        console.log($this.val());

        return;

    });

    $('.form-control-clear').click(  function() {
        var $this = $(this);
        if ( !$('.map').is( ":hidden" ) ) {
            $('.map').slideUp( "slow");

        }
    });

     function getVal(value){
         console.log("here")
        if(value==="NewYork") {
            $('.mapping').attr('src', "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387194.06243047205!2d-74.30933728043162!3d40.69701925911035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%20City%2C%20New%20York%2C%20USA!5e0!3m2!1sde!2s!4v1733964387216!5m2!1sde!2s");
        }
        else if (value==="Ohio")
        {
            $('.mapping').attr('src',"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12086.488716836415!2d-84.6249062978732!3d40.77033394215364!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x883e3f5cd6411433%3A0xcb6245c68360033c!2sOhio%20City%2C%20Ohio%2045874%2C%20USA!5e0!3m2!1sde!2s!4v1733965368855!5m2!1sde!2s" );
        }
        else if (value==="Florida")
        {
            $('.mapping').attr('src',"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28823.460374457038!2d-80.48738112675254!3d25.440518563488695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d9e0cb35a8cf39%3A0xf7bdead0fe918320!2sFlorida%20City%2C%20Florida%2C%20USA!5e0!3m2!1sde!2s!4v1733965636788!5m2!1sde!2s" );
        }
        $('.mapping').load(function() {
            $('.map').slideDown( "slow");
        });
        return;
    };

    document.addEventListener('DOMContentLoaded', function () {
        $('.map').hide();
    });

    
</script>
<!-- <script type="text/javascript">
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
    </script> -->
</body>

</html>
