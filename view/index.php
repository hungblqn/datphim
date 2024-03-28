
    <!-- main-slider -->
    <section class="w3l-main-slider position-relative" id="home">
        <div class="companies20-content">
            <div class="owl-one owl-carousel owl-theme">
                <div class="item">
                    <li>
                        <div class="slider-info banner-view bg bg2">
                            <div class="banner-info">
                                <h3>Trailers phim mới nhất</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<span class="over-para">
                                        Consequuntur hic odio
                                        voluptatem tenetur consequatur.</span></p>
                                <a href="#small-dialog1" class="popup-with-zoom-anim play-view1">
                                    <span class="video-play-icon">
                                        <span class="fa fa-play"></span>
                                    </span>
                                    <h6>Watch Trailer</h6>
                                </a>
                                <div id="small-dialog1" class="zoom-anim-dialog mfp-hide">
                                    <iframe src="https://player.vimeo.com/video/358205676" allow="autoplay; fullscreen"
                                        allowfullscreen=""></iframe>
                                </div>
                            </div>
                        </div>
                    </li>
                </div>
                <div class="item">
                    <li>
                        <div class="slider-info  banner-view banner-top1 bg bg2">
                            <div class="banner-info">
                                <h3>Phim mới nhất</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<span class="over-para">
                                        Consequuntur hic odio
                                        voluptatem tenetur consequatur.</span></p>
                                <a href="#small-dialog2" class="popup-with-zoom-anim play-view1">
                                    <span class="video-play-icon">
                                        <span class="fa fa-play"></span>
                                    </span>
                                    <h6>Watch Trailer</h6>
                                </a>
                                <div id="small-dialog2" class="zoom-anim-dialog mfp-hide">
                                    <iframe src="https://player.vimeo.com/video/395376850" allow="autoplay; fullscreen"
                                        allowfullscreen=""></iframe>
                                </div>
                            </div>
                        </div>
                    </li>
                </div>
                <div class="item">
                    <li>
                        <div class="slider-info banner-view banner-top2 bg bg2">
                            <div class="banner-info">
                                <h3>Trailer</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<span class="over-para">
                                        Consequuntur hic odio
                                        voluptatem tenetur consequatur.</span></p>
                                <a href="#small-dialog3" class="popup-with-zoom-anim play-view1">
                                    <span class="video-play-icon">
                                        <span class="fa fa-play"></span>
                                    </span>
                                    <h6>Watch Trailer</h6>
                                </a>
                                <div id="small-dialog3" class="zoom-anim-dialog mfp-hide">
                                    <iframe src="https://player.vimeo.com/video/389969665" allow="autoplay; fullscreen"
                                        allowfullscreen=""></iframe>
                                </div>
                            </div>
                        </div>
                    </li>
                </div>
                <div class="item">
                    <li>
                        <div class="slider-info banner-view banner-top3 bg bg2">
                            <div class="banner-info">
                                <h3>Phim mới nhất</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<span class="over-para">
                                        Consequuntur hic odio
                                        voluptatem tenetur consequatur.</span></p>
                                <a href="#small-dialog4" class="popup-with-zoom-anim play-view1">
                                    <span class="video-play-icon">
                                        <span class="fa fa-play"></span>
                                    </span>
                                    <h6>Watch Trailer</h6>
                                </a>
                                <div id="small-dialog4" class="zoom-anim-dialog mfp-hide">
                                    <iframe src="https://player.vimeo.com/video/323491174" allow="autoplay; fullscreen"
                                        allowfullscreen=""></iframe>
                                </div>
                            </div>
                        </div>
                    </li>
                </div>
            </div>
        </div>
    </section>
    <!-- main-slider -->
    <!--grids-sec1-->
    <section class="w3l-grids">
        <div class="grids-main py-5">
            <div class="container py-lg-3">
                <div class="headerhny-title">
                    <div class="w3l-title-grids">
                        <div class="headerhny-left">
                            <h3 class="hny-title">Phim phổ biến</h3>
                        </div>
                        <div class="headerhny-right text-lg-right">
                            <h4><a class="show-title" href="#">Show all</a></h4>
                        </div>
                    </div>
                </div>
                <div class="w3l-populohny-grids">
                    <?php
                    try {
                        $products = show_film_all();
                        if ($products) {
                            foreach ($products as $product) {
                                echo '<div class="item vhny-grid">';
                                echo '<div class="box16">';
                                echo '<a href="../controller/index.php?c=details&id_phim=' . $product['id_phim'] . '">';
                                echo '<figure>';
                                echo '<td><img src="../assets/images/' . $product['anh'] . '" alt="' . $product['tenphim'] . '"></td>';
                                echo '</figure>';
                                echo '<div class="box-content">';
                                echo '<h3 class="title">' . $product['tenphim'] . '</h3>';
                                echo '<h4>';
                                echo '<span class="post"><span class="fa fa-clock-o"> </span> ' . $product['thoiluongphim'] . '</span>';
                                echo '<span class="post fa fa-heart text-right"></span>';
                                echo '</h4>';
                                echo '</div>';
                                echo '<span class="fa fa-play video-icon" aria-hidden="true"></span>';
                                echo '</a>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo 'No products found.';
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </div>
            </div>
                 