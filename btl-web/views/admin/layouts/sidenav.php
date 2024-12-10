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

        <link
            href="/public/adminAsset/css/pagination.css"
            rel="stylesheet"
        />

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                    <li class="nav-item <?= strpos($current_path, '/admin/handleUser') !== false ? 'active' : '' ?>">
                        <a class="nav-link" href="/admin/handleUser">
                            <i class="material-icons">person</i>
                            <p>Manange users</p>
                        </a>
                    </li>
                        <li class="nav-item <?= strpos($current_path, '/admin/handleProduct') !== false ? 'active' : '' ?>">
                            <a class="nav-link" href="/admin/handleProduct">
                                <i class="material-icons">store</i>
                                <p>Manage Products</p>
                            </a>
                        </li>

                        <li class="nav-item <?= strpos($current_path, '/admin/news') !== false ? 'active' : '' ?>">
                            <a class="nav-link" href="/admin/news">
                                <i class="material-icons">library_books</i>
                                <p>News</p>
                            </a>
                        </li>

                        <li class="nav-item <?= strpos($current_path, '/admin/setting') !== false ? 'active' : '' ?>">
                            <a class="nav-link" href="/admin/setting">
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
                            <a class="nav-link" href="/">
                                <icons-image
                                    _ngcontent-aye-c22=""
                                    _nghost-aye-c19=""
                                    ><i
                                        _ngcontent-aye-c19=""
                                        class="material-icons icon-image-preview"
                                        >website</i
                                    ></icons-image
                                >
                                <p>See website</p>
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
