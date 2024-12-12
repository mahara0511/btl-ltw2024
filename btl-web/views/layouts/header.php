<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    require_once(ROOT_PATH . '/views/layouts/login_popup.php');
    unset($_SESSION['message']);
}


if (array_key_exists('logout_admin', $_POST)) {
    unset($_SESSION['admin']);
    unset($_SESSION['admin_name']);
    header("location: /admin/login");
    exit();
} else if (array_key_exists('logout', $_POST)) {
    require_once ROOT_PATH . "/controllers/userInfoController.php";
    unset($_POST['logout']);
    userInfoController::logout();
    $request = $_SERVER['REQUEST_URI'];
    $request = parse_url($request, PHP_URL_PATH);
    $parts = explode('/', $request);
    if ($parts[1] == "user_info" || $parts[1] == "password"|| $parts[1] == "place-order"|| $parts[1] == "checkout-form"||
        $parts[1] == "orders"|| $parts[1] == "view_cart") {
        header('Location: /');
        exit();
    } else {
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            require_once(ROOT_PATH . '/views/layouts/login_popup.php');
            unset($_SESSION['message']);
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Online Shopping</title>
    <meta name="keywords" content="shopping, online shopping, iphone, samsung, electronic, clothes">
    <meta name="description" content="Buy all the worlds here. Open from 8am to 17pm all the day">
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="public/css/bootstrap.min.css" />

    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>



    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="public/css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="public/css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="public/css/style.css" />
    <link type="text/css" rel="stylesheet" href="public/css/accountbtn.css" />


    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- ICON -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- SLIDER -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.css">




    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    <style>
        .inline {
            display: inline;
        }

        .link-button {
            background: none;
            border: none;
            color: #fff;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            cursor: pointer;
            transition: 0.2s color;
            font-weight: 500;
        }

        .link-button:hover {
            color: #d10024;
        }

        .link-button:active {
            color: red;
        }

        #navigation {
            background: #FF4E50;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #F9D423, #FF4E50);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #F9D423, #FF4E50);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */


        }

        #header {

            background: #780206;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #061161, #780206);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #061161, #780206);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */


        }

        #top-header {


            background: #870000;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #190A05, #870000);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #190A05, #870000);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */


        }

        #footer {
            background: #7474BF;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #348AC7, #7474BF);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #348AC7, #7474BF);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */


            color: #1E1F29;
        }

        #bottom-footer {
            background: #7474BF;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #348AC7, #7474BF);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #348AC7, #7474BF);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */


        }

        .footer-links li a {
            color: #1E1F29;
        }

        .mainn-raised {

            margin: -7px 0px 0px;
            border-radius: 6px;
            box-shadow: 0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);

        }

        .glyphicon {
            display: inline-block;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: inherit;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .glyphicon-chevron-left:before {
            content: "\f053"
        }

        .glyphicon-chevron-right:before {
            content: "\f054"
        }
    </style>

</head>

<body>
    <!-- HEADER -->

    <?php
    $con = new mysqli('localhost', 'root', '', 'onlineshop');
    $stmt = $con->prepare("SELECT * FROM about_info");
    $stmt->execute();
    $result = $stmt->get_result();
    $about = $result->fetch_assoc();
    $stmt->close();
    ?>
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> <?php echo $about['phone_num'] ?></a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> <?php echo $about['email'] ?></a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i><?php echo $about['location'] ?></a></li>
                </ul>
                <ul class="header-links pull-right">
                    <!-- <li><a href="#"><i class="fa fa-inr"></i> INR</a></li>  -->
                    <li><?php
                    include_once ROOT_PATH . "/config/db.php";
                    if (isset($_COOKIE["uid"]) || isset($_SESSION["uid"])) {
                        if (!isset($_SESSION["uid"])) {
                            $_SESSION["uid"] = $_COOKIE["uid"];
                            $_SESSION["name"] = $_COOKIE["name"];
                        }
                        $sql = "SELECT first_name FROM user_info WHERE user_id='$_SESSION[uid]'";
                        $query = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($query);

                        echo '
                               <div class="dropdownn">
                                  <a href="#" class="dropdownn" data-toggle="modal" data-target="#myModal" ><i class="fa fa-user-o"></i> HI ' . $row["first_name"] . '</a>
                                  <div class="dropdownn-content">
                                    <a href="/user_info" ><i class="fa fa-user-circle" aria-hidden="true" ></i>My Profile</a>
                                    <a href="/orders" ><i class="fa-solid fa-bag-shopping" aria-hidden="true" ></i>My Orders</a>

                                    <form method="post"  class="inline dropdown">
                                        <input type="hidden" name="logout" value="logout">
                                        <button type="submit" name="submit_param" value="submit_value" class="link-button">
                                            <i class="fa fa-sign-in" aria-hidden="true"></i>Log out
                                         </button>
                                    </form>
                                  </div>
                                </div>';

                    } else if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                        echo '
                               <div class="dropdownn">
                                  <a href="#" class="dropdownn" data-toggle="modal" data-target="#myModal" ><i class="fa fa-user-o"></i> HI ' . $_SESSION["admin_name"] . '</a>
                                  <div class="dropdownn-content">
                                    <a href="/admin" ><i class="fa fa-user-circle" aria-hidden="true" ></i>Go to admin</a>
                                    
                                    <form method="post"  class="inline dropdown">
                                        <input type="hidden" name="logout_admin" value="logout_admin">
                                        <button type="submit" name="submit_param" value="submit_value" class="link-button">
                                            <i class="fa fa-sign-in" aria-hidden="true"></i>Log out
                                            
                                         </button>
                                    </form>
                                    
                                    
                                  </div>
                                </div>';
                    } else {
                        echo '
                                <div class="dropdownn">
                                  <a href="#" class="dropdownn" data-toggle="modal" data-target="#myModal" ><i class="fa fa-user-o"></i> My Account</a>
								  <div class="dropdownn-content">
								  	<a href="admin/login" ><i class="fa fa-user" aria-hidden="true" ></i>Admin</a>
                                   <a href="/login" ><i class="fa fa-sign-in" aria-hidden="true" ></i>Login</a>
                                    <a href="/register" ><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a>
                                    
                                  </div>
                                </div>';

                    }
                    ?>

                    </li>
                </ul>

            </div>
        </div>
        <!-- /TOP HEADER -->



        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="/" class="logo">
                                <font style="font-style:normal; font-size: 33px;color: aliceblue;font-family: serif">
                                    Online Shop
                                </font>
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search" style="display: flex; position: relative">
                            <!-- <form> -->
                            <!-- <select class="input-select">
                                    <option value="0">All Categories</option>
                                    <option value="1">Men</option>
                                    <option value="1">Women </option>
                                </select> -->

                            <a class="input" id="search" href="store"
                                style="cursor:pointer ;display: flex; justify-content: center; align-items: center;"
                                type="text" placeholder="">
                                Search Product
                                <i class="fa fa-magnifying-glass"
                                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%)"></i>
                            </a>
                            <!-- <button id="search_btn" class="search-btn" onclick="window.location.href='/store'">Search
                                your favorite
                                products</button> -->
                            <!-- </form> -->
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <!-- Wishlist -->
                            <!-- <div>
                                <a href="">
                                    <i class="fa-brands fa-github"></i>
                                    <span>Github</span>

                                </a>
                            </div> -->
                            <!-- /Wishlist -->

                            <!-- Cart -->
                            <?php include 'cart_popup.php' ?>
                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->
    <nav id='navigation'>
        <!-- container -->
        <div class="container" id="get_category_home">
            <?php
            $current_page = $_SERVER['REQUEST_URI'];
            echo "
                				<!-- responsive-nav -->
				<div id='responsive-nav'>
					<!-- NAV -->
					<ul class='main-nav nav navbar-nav'>
						<li class='" . ($current_page == '/' ? 'active' : '') . "'><a href='/'>Home</a></li>
						<li class='" . ($current_page == '/store' ? 'active' : '') . "'><a href='/store '>Products</a></li>
						<li class='" . ($current_page == '/about_us' ? 'active' : '') . "'><a href='/about_us'>About Us</a></li>
						<li class='" . ($current_page == '/contact_us' ? 'active' : '') . "'><a href='/contact_us'>Contact Us</a></li>
						<li class='" . ($current_page == '/news' ? 'active' : '') . "'><a href='/news'>News</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
                "

                ?>
        </div>
        <!-- responsive-nav -->
        <!-- /container -->
    </nav>
