<!-- Newsletter Section Start -->
<section class="newsletter-section section-b-space">
    <div class="container-fluid-lg">
        <div class="newsletter-box newsletter-box-2">
            <div class="newsletter-contain py-5">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xxl-4 col-lg-5 col-md-7 col-sm-9 offset-xxl-2 offset-md-1">
                            <div class="newsletter-detail">
                                <h2>Join our newsletter and get...</h2>
                                <h5>$20 discount for your first order</h5>
                                <div class="input-box">
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                           placeholder="Enter Your Email">
                                    <i class="fa-solid fa-envelope arrow"></i>
                                    <button class="sub-btn  btn-animation">
                                        <span class="d-sm-block d-none">Subscribe</span>
                                        <i class="fa-solid fa-arrow-right icon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Newsletter Section End -->

<!-- Footer Section Start -->
<footer class="section-t-space">
    <div class="container-fluid-lg">
        <div class="service-section">
            <div class="row g-3">
                <div class="col-12">
                    <div class="service-contain">
                        <div class="service-box">
                            <div class="service-image">
                                <img src="https://themes.pixelstrap.com/fastkart/assets/svg/product.svg"
                                     class="blur-up lazyload" alt="">
                            </div>

                            <div class="service-detail">
                                <h5>Every Fresh Products</h5>
                            </div>
                        </div>

                        <div class="service-box">
                            <div class="service-image">
                                <img src="https://themes.pixelstrap.com/fastkart/assets/svg/delivery.svg"
                                     class="blur-up lazyload" alt="">
                            </div>

                            <div class="service-detail">
                                <h5>Free Delivery For Order Over $50</h5>
                            </div>
                        </div>

                        <div class="service-box">
                            <div class="service-image">
                                <img src="https://themes.pixelstrap.com/fastkart/assets/svg/discount.svg"
                                     class="blur-up lazyload" alt="">
                            </div>

                            <div class="service-detail">
                                <h5>Daily Mega Discounts</h5>
                            </div>
                        </div>

                        <div class="service-box">
                            <div class="service-image">
                                <img src="https://themes.pixelstrap.com/fastkart/assets/svg/market.svg"
                                     class="blur-up lazyload" alt="">
                            </div>

                            <div class="service-detail">
                                <h5>Best Price On The Market</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-footer section-b-space section-t-space">
            <div class="row g-md-4 g-3">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="footer-logo">
                        <div class="theme-logo">
                            <a href="index.php">
                                <img src="<?php echo $extension; ?>assets/images/logo/1.png" class="blur-up lazyload"
                                     alt="">
                            </a>
                        </div>

                        <div class="footer-logo-contain">
                            <p>We are a friendly bar serving a variety of cocktails, wines and beers. Our bar is a
                                perfect place for a couple.</p>

                            <ul class="address">
                                <li>
                                    <i data-feather="home"></i>
                                    <a href="javascript:void(0)"><?php echo $address; ?></a>
                                </li>
                                <li>
                                    <i data-feather="mail"></i>
                                    <a href="javascript:void(0)"><?php echo $email; ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-title">
                        <h4>Categories</h4>
                    </div>

                    <div class="footer-contain">
                        <ul>
                            <?php
                            $addQuery = '';

                            $query = "SELECT * FROM category order by id";

                            $category = $db_handle->runQuery($query);
                            $row_count = $db_handle->numRows($query);

                            for ($i = 0; $i < $row_count; $i++) {
                                ?>
                                <li>
                                    <a href="<?php echo $extension; ?>shop/<?php echo str_replace(' ', '-', $category[$i]['c_name']); ?>"
                                       class="text-content"><?php echo $category[$i]['c_name']; ?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="col-xl col-lg-2 col-sm-3">
                    <div class="footer-title">
                        <h4>Useful Links</h4>
                    </div>

                    <div class="footer-contain">
                        <ul>
                            <li>
                                <a href="<?php echo $extension; ?>home" class="text-content">Home</a>
                            </li>
                            <li>
                                <a href="<?php echo $extension; ?>shop" class="text-content">Shop</a>
                            </li>
                            <li>
                                <a href="<?php echo $extension; ?>faq" class="text-content">FAQ</a>
                            </li>
                            <li>
                                <a href="<?php echo $extension; ?>about" class="text-content">About</a>
                            </li>
                            <li>
                                <a href="<?php echo $extension; ?>contact" class="text-content">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-2 col-sm-3">
                    <div class="footer-title">
                        <h4>Help Center</h4>
                    </div>

                    <div class="footer-contain">
                        <ul>
                            <li>
                                <a href="<?php echo $extension; ?>order-success" class="text-content">Your Order</a>
                            </li>
                            <li>
                                <a href="<?php echo $extension; ?>order-cancel" class="text-content">Cancel Order</a>
                            </li>
                            <li>
                                <a href="<?php echo $extension; ?>order-tracking" class="text-content">Track Order</a>
                            </li>
                            <li>
                                <a href="<?php echo $extension; ?>profile" class="text-content">Your Account</a>
                            </li>
                            <li>
                                <a href="<?php echo $extension; ?>wishlist" class="text-content">Your Wishlist</a>
                            </li>
                            <li>
                                <a href="<?php echo $extension; ?>search" class="text-content">Search</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="footer-title">
                        <h4>Contact Us</h4>
                    </div>

                    <div class="footer-contact">
                        <ul>
                            <li>
                                <div class="footer-number">
                                    <i data-feather="phone"></i>
                                    <div class="contact-number">
                                        <h6 class="text-content">Hotline 24/7 :</h6>
                                        <h5><?php echo $phone; ?></h5>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="footer-number">
                                    <i data-feather="mail"></i>
                                    <div class="contact-number">
                                        <h6 class="text-content">Email Address :</h6>
                                        <h5><?php echo $email; ?></h5>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="sub-footer section-small-space">
            <div class="reserve">
                <h6 class="text-content">©2023 <?php echo $site_name; ?> All rights reserved</h6>
            </div>

            <div class="payment">
                <img src="<?php echo $extension; ?>assets/images/payment/1.png" class="blur-up lazyload" alt="">
            </div>

            <div class="social-link">
                <h6 class="text-content">Stay connected :</h6>
                <ul>
                    <li>
                        <a href="https://www.facebook.com/" target="_blank">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/" target="_blank">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/" target="_blank">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://in.pinterest.com/" target="_blank">
                            <i class="fa-brands fa-pinterest-p"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->
