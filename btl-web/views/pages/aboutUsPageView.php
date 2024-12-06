<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="public/css/bootstrap.min.css"/>

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="public/css/slick.css"/>
    <link type="text/css" rel="stylesheet" href="public/css/slick-theme.css"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="public/css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="public/css/style.css"/>
    <link type="text/css" rel="stylesheet" href="public/css/accountbtn.css"/>
    <link type="text/css" rel="stylesheet" href="public/css/basic.css"/>
    <link type="text/css" rel="stylesheet" href="public/css/aboutUs.css"/>
</head>
<body>
    <?php include ROOT_PATH."/views/layouts/header.php"; ?> 
    <div class="bigwrapper">

        <div class="about-section">
            <h1 class="about-us-title">About Us</h1>
            <p>Some text about who we are and what we do.</p>
            <p>Resize the browser window to see that this page is responsive by the way.</p>
        </div>
    
        <h2 class= "our-team-title" style="text-align:center">Our Team</h2>
        <div class="container about-content">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <img src="public/img/img_avatar3.png" alt="Khanh" style="width:100%">
                        <div class="wrapper">
                            <h2>Nguyen Minh Khanh</h2>
                            <p class="person-title">CEO & Founder</p>
                            <form action="contact_us" method="POST">
                                <input type="hidden" id="dummy" name="dummy" value="">
                                <input type="hidden" id="name" name="name" value="Nguyen Minh Khanh">
                                <input type="hidden" id="email" name="email" value="khanh.nguyenminh0101@hcmut.edu.vn">
                                <input type="hidden" id="pos" name="pos" value="CEO & Founder">
                                <input type="hidden" id="img" name="img" value="img_avatar3.png">
                                <input type="hidden" id="about" name="about" value="Some text about Khanh lorem ipsum.">
                                <p><input type="submit" class="button" value="Contact"></p>
                            </form>
                            <!-- <p><button class="button" onclick="location.href = 'contact_us'">Contact</button></p> -->
                        </div>
                    </div>
                </div>
        
                <div class="col-md-3">
                    <div class="card">
                        <img src="public/img/img_avatar3.png" alt="Tuan" style="width:100%">
                        <div class="wrapper">
                            <h2>Nguyen Truyen Tuan</h2>
                            <p class="person-title">Art Director</p>
                            <form action="contact_us" method="POST">
                                <input type="hidden" id="dummy" name="dummy" value="">
                                <input type="hidden" id="name" name="name" value="Nguyen Truyen Tuan">
                                <input type="hidden" id="email" name="email" value="tuan.nguyenkhmtk22@hcmut.edu.vn">
                                <input type="hidden" id="pos" name="pos" value="Art Director">
                                <input type="hidden" id="img" name="img" value="img_avatar3.png">
                                <input type="hidden" id="about" name="about" value="Some text about Tuan lorem ipsum.">
                                <p><input type="submit" class="button" value="Contact"></p>
                            </form>
                        </div>
                    </div>
                </div>
        
                <div class="col-md-3">
                    <div class="card">
                        <img src="public/img/img_avatar3.png" alt="Anh" style="width:100%">
                        <div class="wrapper">
                            <h2>Tran Nhu Mai Anh</h2>
                            <p class="person-title">Designer</p>
                            <form action="contact_us" method="POST">
                                <input type="hidden" id="dummy" name="dummy" value="">
                                <input type="hidden" id="name" name="name" value="Tran Nhu Mai Anh">
                                <input type="hidden" id="pos" name="pos" value="Designer">
                                <input type="hidden" id="img" name="img" value="img_avatar3.png">
                                <input type="hidden" id="about" name="about" value="Some text about Anh lorem ipsum.">
                                <input type="hidden" id="email" name="email" value="anh.tran2004@hcmut.edu.vn">
                                <p><input type="submit" class="button" value="Contact"></p>
                            </form>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-3">
                    <div class="card">
                        <img src="public/img/img_avatar3.png" alt="Vinh" style="width:100%">
                        <div class="wrapper">
                            <h2>Le Ngoc Vinh</h2>
                            <p class="person-title">CIO</p>
                            <form action="contact_us" method="POST">
                                <input type="hidden" id="dummy" name="dummy" value="">
                                <input type="hidden" id="name" name="name" value="Le Ngoc Vinh">
                                <input type="hidden" id="email" name="email" value="vinh.lengoc@hcmut.edu.vn">
                                <input type="hidden" id="pos" name="pos" value="CIO">
                                <input type="hidden" id="img" name="img" value="img_avatar3.png">
                                <input type="hidden" id="about" name="about" value="Some text about Vinh lorem ipsum.">
                                <p><input type="submit" class="button" value="Contact"></p>
                            </form>
                        </div>
                    </div>
                </div>
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
