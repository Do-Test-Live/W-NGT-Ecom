<?php
session_start();
require_once('include/dbController.php');
$db_handle = new DBController();
require_once('include/settings.php');
date_default_timezone_set("Asia/Hong_Kong");
require_once('include/cart-calculation.php');
$extension = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $meta_description; ?>">
    <meta name="keywords" content="<?php echo $site_name; ?>">
    <meta name="author" content="<?php echo $site_name; ?>">
    <link rel="icon" href="<?php echo $favicon; ?>" type="image/x-icon">
    <title>Home | <?php echo $site_name; ?></title>

    <?php include('include/css.php'); ?>
</head>

<body class="bg-effect">

<?php include('include/header.php'); ?>

<!-- Home Section Start -->
<section class="home-section home-section-ratio pt-2">
    <div class="container-fluid-lg">
        <div class="row g-4">
            <div class="col-xxl-3 col-lg-4 col-sm-6 ratio_180 d-sm-block d-none">
                <div class="home-contain rounded">
                    <div class="h-100">
                        <img src="assets/images/cake/banner/1.jpg" class="bg-img blur-up lazyload" alt="">
                    </div>
                    <div class="home-detail p-top-left home-p-medium">
                        <div>
                            <h6 class="text-danger mb-2 fw-bold">Fresh & Delicious</h6>
                            <h2 class="theme-color fw-bold">Fresh Bread</h2>
                            <p class="text-content d-md-block d-none">Bento box burritos cherry bomb pepper dark and
                                stormy with ginger..</p>
                            <a href="shop-left-sidebar.html" class="shop-button">Shop Now <i
                                        class="fa-solid fa-right-long ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-6 col-lg-8 order-xxl-0 ratio_87">
                <div class="home-contain rounded">
                    <div class="h-100">
                        <img src="assets/images/cake/banner/2.jpg" class="bg-img blur-up lazyload" alt="">
                    </div>
                    <div class="home-detail p-center-left home-p-sm">
                        <div>
                            <h6>Exclusive offer <span>30% Off</span></h6>
                            <h1 class="w-75 text-uppercase name-title poster-2 my-2">
                                we'll make <span class="name">handmade</span> your
                                <span class="name-2">sweet</span>
                            </h1>
                            <p class="w-50">Earl grey latte Thai basil curry grains alfalfa sprouts banana bread
                                ginger carrot...</p>
                            <button onclick="location.href = 'shop-left-sidebar.html';"
                                    class="btn text-white mt-xxl-4 mt-2 home-button mend-auto theme-bg-color">
                                Shop Now <i class="fa-solid fa-right-long icon ms-2"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-4 col-sm-6 ratio_180 custom-ratio d-xxl-block d-lg-none d-sm-block d-none">
                <div class="home-contain rounded">
                    <img src="assets/images/cake/banner/3.jpg" class="bg-img blur-up lazyload" alt="">
                    <div class="home-detail p-top-left home-p-medium">
                        <div>
                            <h6 class="text-danger mb-2 fw-bold">Fresh & Delicious</h6>
                            <h2 class="theme-color fw-bold">Bakery Sweet</h2>
                            <p class="text-content d-md-block d-none">Peanut butter crunch chia seeds red parsley
                                basil overflowing..</p>
                            <a href="shop-left-sidebar.html" class="shop-button">Shop Now <i
                                        class="fa-solid fa-right-long ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home Section End -->

<!-- Product Section Start -->
<section>
    <div class="container-fluid-lg">
        <div class="row g-3">
            <div class="col-xxl-9 col-xl-8">
                <div class="title title-flex">
                    <div>
                        <h2>Top Save Today</h2>
                        <span class="title-leaf">
                                <svg class="icon-width">
                                    <use xlink:href="assets/images/leaf.svg#cake"></use>
                                </svg>
                            </span>
                    </div>
                </div>

                <div class="product-box-slider-2 no-arrow">
                    <?php
                    $query = "SELECT * FROM product order by rand() limit 12";

                    $data = $db_handle->runQuery($query);
                    $row_count = $db_handle->numRows($query);

                    for ($i = 0; $i < $row_count; $i = $i + 2) {
                        $product_id = $data[$i]['id'];
                        ?>
                        <div>
                            <div class="product-box product-box-bg wow fadeInUp">
                                <div class="product-image">
                                    <a onclick="showProduct(<?php echo $product_id; ?>);">
                                        <img src="<?php echo $data[$i]['main_image']; ?>"
                                             class="img-fluid blur-up lazyload" alt="">
                                    </a>
                                    <ul class="product-option">
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="View" onclick="showProduct(<?php echo $product_id; ?>);">
                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>


                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                            <a href="#" class="notifi-wishlist">
                                                <i data-feather="heart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-detail">
                                    <a onclick="showProduct(<?php echo $product_id; ?>);">
                                        <h6 class="name">
                                            <?php echo $data[$i]['p_name']; ?>
                                        </h6>
                                    </a>

                                    <h5 class="sold text-content">
                                        <span class="theme-color price"><?php echo $money_symbol; ?><?php echo $data[$i]['p_price'] - $data[$i]['discount']; ?></span>
                                        <del>
                                            <?php
                                            if ($data[$i]['p_price'] != ($data[$i]['p_price'] - $data[$i]['discount'])) {
                                                echo $data[$i]['p_price'];
                                            }
                                            ?>
                                        </del>
                                    </h5>

                                    <div class="product-rating mt-2">
                                        <h6 class="theme-color">In Stock</h6>
                                    </div>

                                    <div class="add-to-cart-box bg-white">
                                        <button class="btn btn-add-cart">Add to Cart
                                        </button>
                                        <div class="cart_qty qty-box">
                                            <div class="input-group">
                                                <button type="button" class="qty-left-minus" data-type="minus"
                                                        data-field="">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                </button>
                                                <input class="form-control input-number qty-input" type="text"
                                                       name="quantity" value="0">
                                                <button type="button" class="qty-right-plus" data-type="plus"
                                                        data-field="">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($i + 1 < $row_count) {
                                $product_id = $data[$i + 1]['id'];
                                ?>
                                <div class="product-box product-box-bg wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product-image">
                                        <a onclick="showProduct(<?php echo $product_id; ?>);">
                                            <img src="<?php echo $data[$i + 1]['main_image']; ?>"
                                                 class="img-fluid blur-up lazyload" alt="">
                                        </a>
                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View" onclick="showProduct(<?php echo $product_id; ?>);">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                   data-bs-target="#view">
                                                    <i data-feather="eye"></i>
                                                </a>
                                            </li>


                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                <a href="wishlist" class="notifi-wishlist">
                                                    <i data-feather="heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-detail">
                                        <a onclick="showProduct(<?php echo $product_id; ?>);">
                                            <h6 class="name">
                                                <?php echo $data[$i + 1]['p_name']; ?>
                                            </h6>
                                        </a>

                                        <h5 class="sold text-content">
                                            <span class="theme-color price"><?php echo $money_symbol; ?><?php echo $data[$i + 1]['p_price'] - $data[$i + 1]['discount']; ?></span>

                                            <del>
                                                <?php
                                                if ($data[$i + 1]['p_price'] != ($data[$i + 1]['p_price'] - $data[$i + 1]['discount'])) {
                                                    echo $data[$i + 1]['p_price'];
                                                }
                                                ?>
                                            </del>
                                        </h5>

                                        <div class="product-rating mt-2">
                                            <h6 class="theme-color">In Stock</h6>
                                        </div>

                                        <div class="add-to-cart-box bg-white">
                                            <button class="btn btn-add-cart">Add to Cart
                                            </button>
                                            <div class="cart_qty qty-box">
                                                <div class="input-group">
                                                    <button type="button" class="qty-left-minus" data-type="minus"
                                                            data-field="">
                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                           name="quantity" value="0">
                                                    <button type="button" class="qty-right-plus" data-type="plus"
                                                            data-field="">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <div class="title section-t-space">
                    <h2>ALL KINDS OF CAKES</h2>
                    <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="assets/images/leaf.svg#cake"></use>
                            </svg>
                        </span>
                </div>

                <div class="slider-3_2 product-wrapper">
                    <?php
                    $query = "SELECT * FROM product order by rand() limit 9";

                    $data = $db_handle->runQuery($query);
                    $row_count = $db_handle->numRows($query);

                    for ($i = 0; $i < $row_count; $i = $i + 3) {
                        $product_id = $data[$i]['id'];
                        ?>
                        <div>
                            <div class="product-box-2 wow fadeIn">
                                <a onclick="showProduct(<?php echo $product_id; ?>);" class="product-image">
                                    <img src="<?php echo $data[$i]['main_image']; ?>" class="img-fluid blur-up lazyload"
                                         alt="">
                                </a>

                                <div class="product-detail">
                                    <a onclick="showProduct(<?php echo $product_id; ?>);">
                                        <h6><?php echo $data[$i]['p_name']; ?></h6>
                                    </a>
                                    <h5><?php echo $money_symbol; ?><?php echo $data[$i]['p_price'] - $data[$i]['discount']; ?>
                                        <del>
                                            <?php
                                            if ($data[$i]['p_price'] != ($data[$i]['p_price'] - $data[$i]['discount'])) {
                                                echo $money_symbol . $data[$i]['p_price'];
                                            }
                                            ?>
                                        </del>
                                    </h5>
                                </div>
                            </div>

                            <?php
                            if ($i + 1 < $row_count) {
                                $product_id = $data[$i + 1]['id'];
                                ?>
                                <div class="product-box-2 wow fadeIn" data-wow-delay="0.1s">
                                    <a onclick="showProduct(<?php echo $product_id; ?>);" class="product-image">
                                        <img src="<?php echo $data[$i + 1]['main_image']; ?>"
                                             class="img-fluid blur-up lazyload"
                                             alt="">
                                    </a>

                                    <div class="product-detail">
                                        <a onclick="showProduct(<?php echo $product_id; ?>);">
                                            <h6><?php echo $data[$i + 1]['p_name']; ?></h6>
                                        </a>
                                        <h5><?php echo $money_symbol; ?><?php echo $data[$i + 1]['p_price'] - $data[$i + 1]['discount']; ?>
                                            <del>
                                                <?php
                                                if ($data[$i + 1]['p_price'] != ($data[$i + 1]['p_price'] - $data[$i + 1]['discount'])) {
                                                    echo $money_symbol . $data[$i + 1]['p_price'];
                                                }
                                                ?>
                                            </del>
                                        </h5>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>

                            <?php
                            if ($i + 2 < $row_count) {
                                $product_id = $data[$i + 2]['id'];
                                ?>
                                <div class="product-box-2 wow fadeIn" data-wow-delay="0.2s">
                                    <a onclick="showProduct(<?php echo $product_id; ?>);" class="product-image">
                                        <img src="<?php echo $data[$i + 2]['main_image']; ?>"
                                             class="img-fluid blur-up lazyload"
                                             alt="">
                                    </a>

                                    <div class="product-detail">
                                        <a onclick="showProduct(<?php echo $product_id; ?>);">
                                            <h6><?php echo $data[$i + 2]['p_name']; ?></h6>
                                        </a>
                                        <h5><?php echo $money_symbol; ?><?php echo $data[$i + 2]['p_price'] - $data[$i + 2]['discount']; ?>
                                            <del>
                                                <?php
                                                if ($data[$i + 2]['p_price'] != ($data[$i + 2]['p_price'] - $data[$i + 2]['discount'])) {
                                                    echo $money_symbol . $data[$i + 2]['p_price'];
                                                }
                                                ?>
                                            </del>
                                        </h5>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <div class="title section-t-space">
                    <h2>Your Daily Staples</h2>
                    <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="assets/images/leaf.svg#cake"></use>
                            </svg>
                        </span>
                </div>

                <div class="product-box-slider-2 no-arrow">
                    <?php
                    $query = "SELECT * FROM product order by rand() limit 12";

                    $data = $db_handle->runQuery($query);
                    $row_count = $db_handle->numRows($query);

                    for ($i = 0; $i < $row_count; $i = $i + 2) {
                        $product_id = $data[$i]['id'];
                        ?>
                        <div>
                            <div class="product-box product-box-bg wow fadeInUp">
                                <div class="product-image">
                                    <a onclick="showProduct(<?php echo $product_id; ?>);">
                                        <img src="<?php echo $data[$i]['main_image']; ?>"
                                             class="img-fluid blur-up lazyload" alt="">
                                    </a>
                                    <ul class="product-option">
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="View" onclick="showProduct(<?php echo $product_id; ?>);">
                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>


                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                            <a href="wishlist" class="notifi-wishlist">
                                                <i data-feather="heart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-detail">
                                    <a onclick="showProduct(<?php echo $product_id; ?>);">
                                        <h6 class="name">
                                            <?php echo $data[$i]['p_name']; ?>
                                        </h6>
                                    </a>

                                    <h5 class="sold text-content">
                                        <span class="theme-color price"><?php echo $money_symbol; ?><?php echo $data[$i]['p_price'] - $data[$i]['discount']; ?></span>
                                        <del>
                                            <?php
                                            if ($data[$i]['p_price'] != ($data[$i]['p_price'] - $data[$i]['discount'])) {
                                                echo $data[$i]['p_price'];
                                            }
                                            ?>
                                        </del>
                                    </h5>

                                    <div class="product-rating mt-2">
                                        <h6 class="theme-color">In Stock</h6>
                                    </div>

                                    <div class="add-to-cart-box bg-white">
                                        <button class="btn btn-add-cart">Add to Cart
                                        </button>
                                        <div class="cart_qty qty-box">
                                            <div class="input-group">
                                                <button type="button" class="qty-left-minus" data-type="minus"
                                                        data-field="">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                </button>
                                                <input class="form-control input-number qty-input" type="text"
                                                       name="quantity" value="0">
                                                <button type="button" class="qty-right-plus" data-type="plus"
                                                        data-field="">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($i + 1 < $row_count) {
                                $product_id = $data[$i + 1]['id'];
                                ?>
                                <div class="product-box product-box-bg wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product-image">
                                        <a onclick="showProduct(<?php echo $product_id; ?>);">
                                            <img src="<?php echo $data[$i + 1]['main_image']; ?>"
                                                 class="img-fluid blur-up lazyload" alt="">
                                        </a>
                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View" onclick="showProduct(<?php echo $product_id; ?>);">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                   data-bs-target="#view">
                                                    <i data-feather="eye"></i>
                                                </a>
                                            </li>


                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                <a href="wishlist" class="notifi-wishlist">
                                                    <i data-feather="heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-detail">
                                        <a onclick="showProduct(<?php echo $product_id; ?>);">
                                            <h6 class="name">
                                                <?php echo $data[$i + 1]['p_name']; ?>
                                            </h6>
                                        </a>

                                        <h5 class="sold text-content">
                                            <span class="theme-color price"><?php echo $money_symbol; ?><?php echo $data[$i + 1]['p_price'] - $data[$i + 1]['discount']; ?></span>

                                            <del>
                                                <?php
                                                if ($data[$i + 1]['p_price'] != ($data[$i + 1]['p_price'] - $data[$i + 1]['discount'])) {
                                                    echo $data[$i + 1]['p_price'];
                                                }
                                                ?>
                                            </del>
                                        </h5>

                                        <div class="product-rating mt-2">
                                            <h6 class="theme-color">In Stock</h6>
                                        </div>

                                        <div class="add-to-cart-box bg-white">
                                            <button class="btn btn-add-cart">Add to Cart
                                            </button>
                                            <div class="cart_qty qty-box">
                                                <div class="input-group">
                                                    <button type="button" class="qty-left-minus" data-type="minus"
                                                            data-field="">
                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                           name="quantity" value="0">
                                                    <button type="button" class="qty-right-plus" data-type="plus"
                                                            data-field="">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-4 d-none d-xl-block">
                <div class="position-sticky top-0">
                    <div class="ratio_209 rounded wow fadeIn">
                        <div class="banner-contain-2 rounded hover-effect">
                            <img src="assets/images/cake/banner/10.jpg" class="bg-img blur-up lazyload" alt="">
                            <div class="banner-detail p-top-left">
                                <div>
                                    <h6 class="text-uppercase theme-color fw-500">seafood</h6>
                                    <h3 class="text-uppercase">
                                        special <span class="brand-name">brand</span>
                                    </h3>
                                    <p class="text-content fw-500 mt-3 lh-lg">Special offer on the discount very
                                        hungry cake and sweets</p>

                                    <div class="banner-detail-box banner-detail-box-2 mb-md-3 mb-1">
                                        <h4 class="text-uppercase">up to</h4>
                                        <h2 class="mt-2">50%</h2>
                                        <h3 class="text-uppercase">off</h3>
                                    </div>

                                    <div>
                                        <button onclick="location.href = 'shop-left-sidebar.html';"
                                                class="btn text-white btn-md mt-xxl-4 mt-2 home-button mend-auto theme-bg-color">
                                            Shop
                                            Now<i class="fa-solid fa-right-long icon ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ratio_125 section-t-space wow fadeIn">
                        <div class="banner-contain-2 rounded hover-effect">
                            <img src="assets/images/cake/banner/9.jpg" class="bg-img blur-up lazyload" alt="">
                            <div class="banner-detail p-top-left">
                                <div>
                                    <h6 class="text-uppercase theme-color fw-500">Freash Every Day!</h6>
                                    <h3 class="text-pacifico mt-2">Delicioud <span class="theme-color">Bread</span>
                                    </h3>
                                    <p class="text-content fw-500 mt-3 w-75 mend-auto">Delicioud Bread and Brend new
                                        fresh bread.</p>
                                    <button onclick="location.href = 'shop-left-sidebar.html';"
                                            class="btn text-white btn-md mt-2 home-button mend-auto theme-bg-color">
                                        Shop Now <i class="fa-solid fa-right-long icon ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ratio_125 section-t-space wow fadeIn">
                        <div class="banner-contain-2 rounded hover-effect">
                            <img src="assets/images/cake/banner/9.jpg" class="bg-img blur-up lazyload" alt="">
                            <div class="banner-detail p-top-left">
                                <div>
                                    <h6 class="text-uppercase theme-color fw-500">Freash Every Day!</h6>
                                    <h3 class="text-pacifico mt-2">Delicioud <span class="theme-color">Bread</span>
                                    </h3>
                                    <p class="text-content fw-500 mt-3 w-75 mend-auto">Delicioud Bread and Brend new
                                        fresh bread.</p>
                                    <button onclick="location.href = 'shop-left-sidebar.html';"
                                            class="btn text-white btn-md mt-2 home-button mend-auto theme-bg-color">
                                        Shop Now <i class="fa-solid fa-right-long icon ms-2"></i>
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
<!-- Product Section End -->

<!-- Banner Section Start -->
<section>
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="home-contain hover-effect">
                    <img src="assets/images/cake/banner/11.jpg" class="bg-img blur-up lazyload" alt="">
                    <div class="home-detail p-center position-relative text-center">
                        <div>
                            <h3 class="text-danger text-uppercase fw-bold mb-0">
                                limited Time Offer
                            </h3>
                            <h2 class="theme-color text-pacifico fw-normal mb-0 super-sale text-center">
                                Super
                            </h2>
                            <h2 class="home-name text-uppercase">sale</h2>
                            <h3 class="text-pacifico fw-normal text-content text-center">
                                www.<?php echo $site_name; ?>.com
                            </h3>
                            <ul class="social-icon">
                                <li>
                                    <a href="https://www.instagram.com/">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="https://www.facebook.com/">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="https://twitter.com/">
                                        <i class="fa-brands fa-twitter"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="https://www.whatsapp.com/">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Top Selling Section Start -->
<section class="top-selling-section">
    <div class="container-fluid-lg">
        <div class="slider-4-1">
            <div>
                <div class="row">
                    <div class="col-12">
                        <div class="top-selling-box">
                            <div class="top-selling-title">
                                <h3>Top Selling</h3>
                            </div>

                            <?php
                            $query = "SELECT * FROM product order by rand() limit 3";

                            $data = $db_handle->runQuery($query);
                            $row_count = $db_handle->numRows($query);

                            for ($i = 0; $i < $row_count; $i = $i + 3) {
                                $product_id = $data[$i]['id'];
                                ?>
                                <div class="top-selling-contain wow fadeInUp">
                                    <a onclick="showProduct(<?php echo $product_id; ?>);" class="top-selling-image">
                                        <img src="<?php echo $data[$i]['main_image']; ?>" class="img-fluid blur-up lazyload"
                                             alt="">
                                    </a>

                                    <div class="top-selling-detail">
                                        <a onclick="showProduct(<?php echo $product_id; ?>);">
                                            <h5><?php echo $data[$i]['p_name']; ?></h5>
                                        </a>
                                        <h6><?php echo $money_symbol; ?> <?php echo $data[$i]['p_price'] - $data[$i]['discount']; ?></h6>
                                    </div>
                                </div>
                                <?php
                                if ($i + 1 < $row_count) {
                                    $product_id = $data[$i + 1]['id'];
                                    ?>
                                    <div class="top-selling-contain wow fadeInUp" data-wow-delay="0.2s">
                                        <a onclick="showProduct(<?php echo $product_id; ?>);" class="top-selling-image">
                                            <img src="<?php echo $data[$i+1]['main_image']; ?>" class="img-fluid blur-up lazyload"
                                                 alt="">
                                        </a>

                                        <div class="top-selling-detail">
                                            <a onclick="showProduct(<?php echo $product_id; ?>);">
                                                <h5><?php echo $data[$i+1]['p_name']; ?></h5>
                                            </a>
                                            <h6><?php echo $money_symbol; ?> <?php echo $data[$i+1]['p_price'] - $data[$i+1]['discount']; ?></h6>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($i + 2 < $row_count) {
                                    $product_id = $data[$i + 2]['id'];
                                    ?>
                                    <div class="top-selling-contain wow fadeInUp" data-wow-delay="0.4s">
                                        <a onclick="showProduct(<?php echo $product_id; ?>);" class="top-selling-image">
                                            <img src="<?php echo $data[$i+2]['main_image']; ?>" class="img-fluid blur-up lazyload"
                                                 alt="">
                                        </a>

                                        <div class="top-selling-detail">
                                            <a onclick="showProduct(<?php echo $product_id; ?>);">
                                                <h5><?php echo $data[$i+2]['p_name']; ?></h5>
                                            </a>
                                            <h6><?php echo $money_symbol; ?> <?php echo $data[$i+2]['p_price'] - $data[$i+1]['discount']; ?></h6>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="row">
                    <div class="col-12">
                        <div class="top-selling-box">
                            <div class="top-selling-title">
                                <h3>Trending Products</h3>
                            </div>

                            <?php
                            $query = "SELECT * FROM product order by rand() limit 3";

                            $data = $db_handle->runQuery($query);
                            $row_count = $db_handle->numRows($query);

                            for ($i = 0; $i < $row_count; $i = $i + 3) {
                                $product_id = $data[$i]['id'];
                                ?>
                                <div class="top-selling-contain wow fadeInUp">
                                    <a onclick="showProduct(<?php echo $product_id; ?>);" class="top-selling-image">
                                        <img src="<?php echo $data[$i]['main_image']; ?>" class="img-fluid blur-up lazyload"
                                             alt="">
                                    </a>

                                    <div class="top-selling-detail">
                                        <a onclick="showProduct(<?php echo $product_id; ?>);">
                                            <h5><?php echo $data[$i]['p_name']; ?></h5>
                                        </a>
                                        <h6><?php echo $money_symbol; ?> <?php echo $data[$i]['p_price'] - $data[$i]['discount']; ?></h6>
                                    </div>
                                </div>
                                <?php
                                if ($i + 1 < $row_count) {
                                    $product_id = $data[$i + 1]['id'];
                                    ?>
                                    <div class="top-selling-contain wow fadeInUp" data-wow-delay="0.2s">
                                        <a onclick="showProduct(<?php echo $product_id; ?>);" class="top-selling-image">
                                            <img src="<?php echo $data[$i+1]['main_image']; ?>" class="img-fluid blur-up lazyload"
                                                 alt="">
                                        </a>

                                        <div class="top-selling-detail">
                                            <a onclick="showProduct(<?php echo $product_id; ?>);">
                                                <h5><?php echo $data[$i+1]['p_name']; ?></h5>
                                            </a>
                                            <h6><?php echo $money_symbol; ?> <?php echo $data[$i+1]['p_price'] - $data[$i+1]['discount']; ?></h6>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($i + 2 < $row_count) {
                                    $product_id = $data[$i + 2]['id'];
                                    ?>
                                    <div class="top-selling-contain wow fadeInUp" data-wow-delay="0.4s">
                                        <a onclick="showProduct(<?php echo $product_id; ?>);" class="top-selling-image">
                                            <img src="<?php echo $data[$i+2]['main_image']; ?>" class="img-fluid blur-up lazyload"
                                                 alt="">
                                        </a>

                                        <div class="top-selling-detail">
                                            <a onclick="showProduct(<?php echo $product_id; ?>);">
                                                <h5><?php echo $data[$i+2]['p_name']; ?></h5>
                                            </a>
                                            <h6><?php echo $money_symbol; ?> <?php echo $data[$i+2]['p_price'] - $data[$i+1]['discount']; ?></h6>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="row">
                    <div class="col-12">
                        <div class="top-selling-box">
                            <div class="top-selling-title">
                                <h3>Recently added</h3>
                            </div>

                            <?php
                            $query = "SELECT * FROM product order by rand() limit 3";

                            $data = $db_handle->runQuery($query);
                            $row_count = $db_handle->numRows($query);

                            for ($i = 0; $i < $row_count; $i = $i + 3) {
                                $product_id = $data[$i]['id'];
                                ?>
                                <div class="top-selling-contain wow fadeInUp">
                                    <a onclick="showProduct(<?php echo $product_id; ?>);" class="top-selling-image">
                                        <img src="<?php echo $data[$i]['main_image']; ?>" class="img-fluid blur-up lazyload"
                                             alt="">
                                    </a>

                                    <div class="top-selling-detail">
                                        <a onclick="showProduct(<?php echo $product_id; ?>);">
                                            <h5><?php echo $data[$i]['p_name']; ?></h5>
                                        </a>
                                        <h6><?php echo $money_symbol; ?> <?php echo $data[$i]['p_price'] - $data[$i]['discount']; ?></h6>
                                    </div>
                                </div>
                                <?php
                                if ($i + 1 < $row_count) {
                                    $product_id = $data[$i + 1]['id'];
                                    ?>
                                    <div class="top-selling-contain wow fadeInUp" data-wow-delay="0.2s">
                                        <a onclick="showProduct(<?php echo $product_id; ?>);" class="top-selling-image">
                                            <img src="<?php echo $data[$i+1]['main_image']; ?>" class="img-fluid blur-up lazyload"
                                                 alt="">
                                        </a>

                                        <div class="top-selling-detail">
                                            <a onclick="showProduct(<?php echo $product_id; ?>);">
                                                <h5><?php echo $data[$i+1]['p_name']; ?></h5>
                                            </a>
                                            <h6><?php echo $money_symbol; ?> <?php echo $data[$i+1]['p_price'] - $data[$i+1]['discount']; ?></h6>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($i + 2 < $row_count) {
                                    $product_id = $data[$i + 2]['id'];
                                    ?>
                                    <div class="top-selling-contain wow fadeInUp" data-wow-delay="0.4s">
                                        <a onclick="showProduct(<?php echo $product_id; ?>);" class="top-selling-image">
                                            <img src="<?php echo $data[$i+2]['main_image']; ?>" class="img-fluid blur-up lazyload"
                                                 alt="">
                                        </a>

                                        <div class="top-selling-detail">
                                            <a onclick="showProduct(<?php echo $product_id; ?>);">
                                                <h5><?php echo $data[$i+2]['p_name']; ?></h5>
                                            </a>
                                            <h6><?php echo $money_symbol; ?> <?php echo $data[$i+2]['p_price'] - $data[$i+1]['discount']; ?></h6>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="row">
                    <div class="col-12">
                        <div class="top-selling-box">
                            <div class="top-selling-title">
                                <h3>Top Rated</h3>
                            </div>

                            <?php
                            $query = "SELECT * FROM product order by rand() limit 3";

                            $data = $db_handle->runQuery($query);
                            $row_count = $db_handle->numRows($query);

                            for ($i = 0; $i < $row_count; $i = $i + 3) {
                                $product_id = $data[$i]['id'];
                                ?>
                                <div class="top-selling-contain wow fadeInUp">
                                    <a onclick="showProduct(<?php echo $product_id; ?>);" class="top-selling-image">
                                        <img src="<?php echo $data[$i]['main_image']; ?>" class="img-fluid blur-up lazyload"
                                             alt="">
                                    </a>

                                    <div class="top-selling-detail">
                                        <a onclick="showProduct(<?php echo $product_id; ?>);">
                                            <h5><?php echo $data[$i]['p_name']; ?></h5>
                                        </a>
                                        <h6>$ <?php echo $data[$i]['p_price'] - $data[$i]['discount']; ?></h6>
                                    </div>
                                </div>
                                <?php
                                if ($i + 1 < $row_count) {
                                    $product_id = $data[$i + 1]['id'];
                                    ?>
                                    <div class="top-selling-contain wow fadeInUp" data-wow-delay="0.2s">
                                        <a onclick="showProduct(<?php echo $product_id; ?>);" class="top-selling-image">
                                            <img src="<?php echo $data[$i+1]['main_image']; ?>" class="img-fluid blur-up lazyload"
                                                 alt="">
                                        </a>

                                        <div class="top-selling-detail">
                                            <a onclick="showProduct(<?php echo $product_id; ?>);">
                                                <h5><?php echo $data[$i+1]['p_name']; ?></h5>
                                            </a>
                                            <h6><?php echo $money_symbol; ?> <?php echo $data[$i+1]['p_price'] - $data[$i+1]['discount']; ?></h6>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($i + 2 < $row_count) {
                                    $product_id = $data[$i + 2]['id'];
                                    ?>
                                    <div class="top-selling-contain wow fadeInUp" data-wow-delay="0.4s">
                                        <a onclick="showProduct(<?php echo $product_id; ?>);" class="top-selling-image">
                                            <img src="<?php echo $data[$i+2]['main_image']; ?>" class="img-fluid blur-up lazyload"
                                                 alt="">
                                        </a>

                                        <div class="top-selling-detail">
                                            <a onclick="showProduct(<?php echo $product_id; ?>);">
                                                <h5><?php echo $data[$i+2]['p_name']; ?></h5>
                                            </a>
                                            <h6><?php echo $money_symbol; ?> <?php echo $data[$i+2]['p_price'] - $data[$i+1]['discount']; ?></h6>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Top Selling Section End -->

<?php include('include/footer.php'); ?>

<script>
    async function showProduct(id) {
        $.ajax({
            type: "POST",
            url: "fetch-product-modal",
            data: {id: id},
            success:async function(msg){
                $("#showProduct").html(msg)
            },
            error: function(){
                alert("failure");
            }
        });
    }
</script>

<!-- Quick View Modal Box Start -->
<div class="modal fade theme-modal view-modal" id="view" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header p-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row g-sm-4 g-2" id="showProduct">
                    <div class="col-lg-6">
                        <div class="slider-image">
                            <img src="assets/images/product/category/1.jpg" class="img-fluid blur-up lazyload"
                                 alt="">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="right-sidebar-modal">
                            <h4 class="title-name">Peanut Butter Bite Premium Butter Cookies 600 g</h4>
                            <h4 class="price">$36.99</h4>

                            <div class="product-detail">
                                <h4>Product Details :</h4>
                                <p>Candy canes sugar plum tart cotton candy chupa chups sugar plum chocolate I love.
                                    Caramels marshmallow icing dessert candy canes I love soufflé I love toffee.
                                    Marshmallow pie sweet sweet roll sesame snaps tiramisu jelly bear claw. Bonbon
                                    muffin I love carrot cake sugar plum dessert bonbon.</p>
                            </div>

                            <ul class="brand-list">
                                <li>
                                    <div class="brand-box">
                                        <h5>Brand Name:</h5>
                                        <h6>Black Forest</h6>
                                    </div>
                                </li>

                                <li>
                                    <div class="brand-box">
                                        <h5>Product Code:</h5>
                                        <h6>W0690034</h6>
                                    </div>
                                </li>

                                <li>
                                    <div class="brand-box">
                                        <h5>Product Type:</h5>
                                        <h6>White Cream Cake</h6>
                                    </div>
                                </li>
                            </ul>
                            <div class="modal-button">
                                <button onclick="location.href = 'cart.html';"
                                        class="btn btn-md add-cart-button icon">Add
                                    To Cart
                                </button>
                                <button onclick="location.href = 'product-left.html';"
                                        class="btn theme-bg-color view-button icon text-white fw-bold btn-md">
                                    View More Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick View Modal Box End -->

<?php include('include/js.php'); ?>

</body>
</html>
