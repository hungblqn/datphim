<?php
session_start();
ob_start();
?>
<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home</title>

    <link rel="stylesheet" href="../assets/css/style-starter.css">
    <link href="//fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,600&display=swap"
        rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

</head>

<body>

    <!-- header -->
    <header id="site-header" class="w3l-header fixed-top">
        <!--/nav-->
        <nav class="navbar navbar-expand-lg navbar-light fill px-lg-0 py-0 px-3">
            <div class="container">
                <h1><a class="navbar-brand" href="index.html"><span class="fa fa-play icon-log"
                            aria-hidden="true"></span>
                        MyShowz</a></h1>
                <!-- if logo is image enable this   
                        <a class="navbar-brand" href="#index.html">
                            <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
                        </a> -->
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> -->
                    <span class="fa icon-expand fa-bars"></span>
                    <span class="fa icon-close fa-times"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="../controller/index.php">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">Về chúng tôi</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="Contact_Us.html">Liên hệ</a>
                        </li>
                    </ul>

                    <!--/search-right-->
                    <!--/search-right-->
                    <div class="search-right">
                        <a href="#search" class="btn search-hny mr-lg-3 mt-lg-0 mt-4" title="search">Search <span
                                class="fa fa-search ml-3" aria-hidden="true"></span></a>
                        <!-- search popup -->
                        <div id="search" class="pop-overlay">
                            <div class="popup">
                                <form action="#" method="post" class="search-box">
                                    <input type="search" placeholder="Search your Keyword" name="search"
                                        required="required" autofocus="">
                                    <button type="submit" class="btn"><span class="fa fa-search"
                                            aria-hidden="true"></span></button>
                                </form>
                                <div class="browse-items">
                                    <h3 class="hny-title two mt-md-5 mt-4">Browse all:</h3>
                                    <ul class="search-items">
                                        <li><a href="movies.html">Hành động</a></li>
                                        <li><a href="movies.html">Drama</a></li>
                                        <li><a href="movies.html">Gia đình</a></li>
                                        <li><a href="movies.html">Hài</a></li>
                                        <li><a href="movies.html">Lãng mạn</a></li>
                                        <li><a href="movies.html">Phim truyền hình</a></li>
                                        <li><a href="movies.html">Kinh dị</a></li>

                                    </ul>
                                </div>
                            </div>
                            <a class="close" href="#close">×</a>
                        </div>
                        <!-- /search popup -->
                        <!--/search-right-->

                    </div>
                   
                        <!-- <li class="nav-item"> -->
                        <?php
                            if (isset($_SESSION['name'])) {
                                echo '
                                <div class="Login_SignUp" id="login"
                                style="font-size: 25px ; display: inline-block; position: relative;">
                                <a class="nav-link" href="../controller/index.php?c=userinfo"><i class="fa fa-user-circle-o"></i>' . $_SESSION['name'] . '</a>';
                                echo '</div>';
                                echo '
                                <ul class="navbar-nav">
                                <li class="nav-item">
                                <a class="nav-link" href="../controller/index.php?c=logout">Logout</a>
                                </li></u>
                               ';

                            } else {
                                echo '
                                <div class="Login_SignUp" id="login"
                                style="font-size: 2rem ; display: inline-block; position: relative;">
                                <a class="nav-link" href="../controller/index.php?c=login"><i class="fa fa-user-circle-o"></i></a>';
                                echo '</div>';
                            }
                        ?>
                        <!-- </li> -->
                    
                </div>
                <!-- toggle switch for light and dark theme -->
                <div class="mobile-position">
                    <nav class="navigation">
                        <div class="theme-switch-wrapper">
                            <label class="theme-switch" for="checkbox">
                                <input type="checkbox" id="checkbox">
                                <div class="mode-container">
                                    <i class="gg-sun"></i>
                                    <i class="gg-moon"></i>
                                </div>
                            </label>
                        </div>
                    </nav>
                </div>
            </div>
        </nav>
    </header>