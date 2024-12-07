<?php

  if (!isset($_SESSION['admin_name'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: /admin/login');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['admin_name']);
    header("location: /admin/login");
  }

  $current_path = $_SERVER['REQUEST_URI'];

//   $url = parse_url($current_path);
//   $current_path = $url['path'];
//   echo $current_path;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link
            rel="apple-touch-icon"
            sizes="76x76"
            href="/public/adminAsset/img/apple-icon.png"
        />
        <link rel="icon" type="image/png" href="/public/adminAsset/img/favicon.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>TechShop|Admin</title>
        <meta
            content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no"
            name="viewport"
        />

        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css"
            rel="stylesheet"
        />
        <!--     Fonts and icons     -->
        <link
            rel="stylesheet"
            type="text/css"
            href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"
        />
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"
        />
        <!-- CSS Files -->

        <link
            href="/public/adminAsset/css/material-dashboard.css"
            rel="stylesheet"
        />
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <!-- <link href="public/adminAsset/demo/demo.css" rel="stylesheet" /> -->
    </head>

    <body class="dark-edition">
        <div class="wrapper">
            <div
                class="sidebar"
                data-color="purple"
                data-background-color="black"
                data-image="/public/adminAsset/img/sidebar-2.jpg"
            >
                <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
                <div class="logo">
                    <a href="/admin" class="simple-text logo-normal">
                        <img
                            src="/public/adminAsset/img/new_logo.png"
                            style="width: 150px"
                        />
                    </a>
                </div>
                <div class="sidebar-wrapper">
                    <ul class="nav">
                    <li class="nav-item <?= $current_path === '/admin' ? 'active' : '' ?>">
                        <a class="nav-link" href="/admin">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item <?= $current_path === '/admin/handleUser' ? 'active' : '' ?>">
                        <a class="nav-link" href="/admin/handleUser">
                            <i class="material-icons">person</i>
                            <p>Handle users</p>
                        </a>
                    </li>
                        <li class="nav-item <?= $current_path === '/admin/handleProduct' ? 'active' : '' ?>">
                            <a class="nav-link" href="/admin/handleProduct">
                                <i class="material-icons">add</i>
                                <p>Handle Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products_list.php">
                                <i class="material-icons">list</i>
                                <p>Product List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manageuser.php">
                                <i class="material-icons">person</i>
                                <p>Manage users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="activity.php">
                                <i class="material-icons">timeline</i>
                                <p>Activities</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">
                                <icons-image
                                    _ngcontent-aye-c22=""
                                    _nghost-aye-c19=""
                                    ><i
                                        _ngcontent-aye-c19=""
                                        class="material-icons icon-image-preview"
                                        >settings</i
                                    ></icons-image
                                >
                                <p>setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="salesofday.php">
                                <i class="material-icons">library_books</i>
                                <p>sales</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="../../chat/login.php">
                                <i class="material-icons">notifications</i>
                                <p>Discussion</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item active-pro ">
                <a class="nav-link" href="./upgrade.html">
                    <i class="material-icons">unarchive</i>
                    <p>Upgrade to PRO</p>
                </a>
            </li> -->
                    </ul>
                </div>
            </div>
