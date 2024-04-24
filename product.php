<?php
session_start();
require_once('include/dbController.php');
$db_handle = new DBController();
require_once('include/settings.php');
date_default_timezone_set("Asia/Hong_Kong");
require_once('include/cart-calculation.php');
$extension = '';

$url = $_SERVER['REQUEST_URI'];
$title = str_replace('-', ' ', substr($url, strrpos($url, '/') + 1));

$query = "SELECT * FROM product where p_name='$title'";

$product = $db_handle->runQuery($query);
$row_count = $db_handle->numRows($query);
$product_id = $category_id = $subcategory_id = $p_name = $p_price = $discount = $product_quantity = $main_image = $description = $extra_image = '';

for ($i = 0; $i < $row_count; $i++) {
    $product_id = $product[$i]['id'];
    $category_id = $product[$i]['category_id'];
    $subcategory_id = $product[$i]['subcategory_id'];
    $p_name = $product[$i]['p_name'];
    $p_price = $product[$i]['p_price'];
    $discount = $product[$i]['discount'];
    $product_quantity = $product[$i]['product_quantity'];
    $main_image = $product[$i]['main_image'];
    $description = $product[$i]['description'];
    $extra_image = $product[$i]['extra_image'];
    $extension = '../';
}

//if ($row_count == 0) {
//    header('location:404');
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $site_name; ?>">
    <meta name="keywords" content="<?php echo $site_name; ?>">
    <meta name="author" content="<?php echo $site_name; ?>">
    <link rel="icon" href="<?php echo $extension; ?>assets/images/favicon/1.png" type="image/x-icon">
    <title>Product | <?php echo $site_name; ?></title>

    <?php include('include/css.php'); ?>
</head>

<body>

<?php include('include/header.php'); ?>

<!-- Breadcrumb Section Start -->
<section class="breadscrumb-section pt-0">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadscrumb-contain">
                    <h2><?php echo $p_name; ?></h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="<?php echo $extension; ?>home">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>

                            <li class="breadcrumb-item active"><?php echo $p_name; ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Left Sidebar Start -->
<section class="product-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-9 col-xl-8 col-lg-7 wow fadeInUp">
                <div class="row g-4">
                    <div class="col-xl-6 wow fadeInUp">
                        <div class="product-left-box">
                            <div class="row g-2">
                                <div class="col-12">
                                    <div class="product-main-1 no-arrow">
                                        <div>
                                            <div class="slider-image">
                                                <img src="<?php echo $extension; ?><?php echo $main_image; ?>"
                                                     id="img-1"
                                                     data-zoom-image="../<?php echo $extension; ?><?php echo $main_image; ?>"
                                                     class="img-fluid image_zoom_cls-0 blur-up lazyload" alt="">
                                            </div>
                                        </div>

                                        <?php
                                        $urls = $extra_image;
                                        if ($urls != '[]') {
                                            foreach ($urls as $url) {
                                                ?>
                                                <div>
                                                    <div class="slider-image">
                                                        <img src="<?php echo $extension; ?><?php echo $url; ?>"
                                                             data-zoom-image="../<?php echo $extension; ?><?php echo $url; ?>"
                                                             class="img-fluid image_zoom_cls-1 blur-up lazyload" alt="">
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="bottom-slider-image left-slider no-arrow slick-top">
                                        <div>
                                            <div class="sidebar-image">
                                                <img src="<?php echo $extension; ?><?php echo $main_image; ?>"
                                                     class="img-fluid blur-up lazyload" alt="">
                                            </div>
                                        </div>

                                        <?php
                                        $urls = $extra_image;

                                        if ($urls != '[]') {
                                            foreach ($urls as $url) {
                                                ?>
                                                <div>
                                                    <div class="sidebar-image">
                                                        <img src="<?php echo $extension; ?><?php echo $url; ?>"
                                                             class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="right-box-contain">
                            <h6 class="offer-top">30% Off</h6>
                            <h2 class="name"><?php echo $p_name; ?></h2>
                            <div class="price-rating">
                                <h3 class="theme-color price"><?php echo $money_symbol; ?><?php echo $p_price; ?>
                                    <del class="text-content"><?php echo $money_symbol; ?><?php echo $discount; ?></del>
                                </h3>
                                <div class="product-rating custom-rate">
                                    <ul class="rating">
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star"></i>
                                        </li>
                                    </ul>
                                    <span class="review">23 Customer Review</span>
                                </div>
                            </div>

                            <div class="procuct-contain">
                                <p>
                                    <?php echo $description; ?>
                                </p>
                            </div>

                            <form action="?action=add" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" required>
                                <div class="note-box product-packege">
                                    <div class="cart_qty qty-box product-qty">
                                        <div class="input-group">
                                            <button type="button" class="qty-left-minus" data-type="minus"
                                                    data-field="">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </button>
                                            <input class="form-control input-number qty-input" type="text"
                                                   name="quantity" value="1">
                                            <button type="button" class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-md bg-dark cart-button text-white ps-5 pe-5 mt-3">
                                    Add To Cart
                                </button>
                            </form>

                            <div class="buy-box">
                                <a href="<?php echo $extension; ?>wishlist">
                                    <i data-feather="heart"></i>
                                    <span>Add To Wishlist</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="product-section-box">
                            <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="review-tab" data-bs-toggle="tab"
                                            data-bs-target="#review" type="button" role="tab" aria-controls="review"
                                            aria-selected="false">Review
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content custom-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="review" role="tabpanel"
                                     aria-labelledby="review-tab">
                                    <div class="review-box">
                                        <div class="row g-4">
                                            <div class="col-xl-6">
                                                <div class="review-title">
                                                    <h4 class="fw-500">Customer reviews</h4>
                                                </div>

                                                <div class="d-flex">
                                                    <div class="product-rating">
                                                        <ul class="rating">
                                                            <li>
                                                                <i data-feather="star" class="fill"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star" class="fill"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star" class="fill"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star"></i>
                                                            </li>
                                                            <li>
                                                                <i data-feather="star"></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <h6 class="ms-3">4.2 Out Of 5</h6>
                                                </div>

                                                <div class="rating-box">
                                                    <ul>
                                                        <li>
                                                            <div class="rating-list">
                                                                <h5>5 Star</h5>
                                                                <div class="progress">
                                                                    <div class="progress-bar" role="progressbar"
                                                                         style="width: 68%" aria-valuenow="100"
                                                                         aria-valuemin="0" aria-valuemax="100">
                                                                        68%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="rating-list">
                                                                <h5>4 Star</h5>
                                                                <div class="progress">
                                                                    <div class="progress-bar" role="progressbar"
                                                                         style="width: 67%" aria-valuenow="100"
                                                                         aria-valuemin="0" aria-valuemax="100">
                                                                        67%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="rating-list">
                                                                <h5>3 Star</h5>
                                                                <div class="progress">
                                                                    <div class="progress-bar" role="progressbar"
                                                                         style="width: 42%" aria-valuenow="100"
                                                                         aria-valuemin="0" aria-valuemax="100">
                                                                        42%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="rating-list">
                                                                <h5>2 Star</h5>
                                                                <div class="progress">
                                                                    <div class="progress-bar" role="progressbar"
                                                                         style="width: 30%" aria-valuenow="100"
                                                                         aria-valuemin="0" aria-valuemax="100">
                                                                        30%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="rating-list">
                                                                <h5>1 Star</h5>
                                                                <div class="progress">
                                                                    <div class="progress-bar" role="progressbar"
                                                                         style="width: 24%" aria-valuenow="100"
                                                                         aria-valuemin="0" aria-valuemax="100">
                                                                        24%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="review-title">
                                                    <h4 class="fw-500">Add a review</h4>
                                                </div>

                                                <div class="row g-4">
                                                    <div class="col-md-6">
                                                        <div class="form-floating theme-form-floating">
                                                            <input type="text" class="form-control" id="name"
                                                                   placeholder="Name">
                                                            <label for="name">Your Name</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-floating theme-form-floating">
                                                            <input type="email" class="form-control" id="email"
                                                                   placeholder="Email Address">
                                                            <label for="email">Email Address</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-floating theme-form-floating">
                                                            <input type="url" class="form-control" id="website"
                                                                   placeholder="Website">
                                                            <label for="website">Website</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-floating theme-form-floating">
                                                            <input type="url" class="form-control" id="review1"
                                                                   placeholder="Give your review a title">
                                                            <label for="review1">Review Title</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-floating theme-form-floating">
                                                                <textarea class="form-control"
                                                                          placeholder="Leave a comment here"
                                                                          id="floatingTextarea2"
                                                                          style="height: 150px"></textarea>
                                                            <label for="floatingTextarea2">Write Your
                                                                Comment</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="review-title">
                                                    <h4 class="fw-500">Customer questions & answers</h4>
                                                </div>

                                                <div class="review-people">
                                                    <ul class="review-list">
                                                        <li>
                                                            <div class="people-box">
                                                                <div>
                                                                    <div class="people-image">
                                                                        <img src="<?php echo $extension; ?>assets/images/review/1.jpg"
                                                                             class="img-fluid blur-up lazyload"
                                                                             alt="">
                                                                    </div>
                                                                </div>

                                                                <div class="people-comment">
                                                                    <a class="name"
                                                                       href="javascript:void(0)">Tracey</a>
                                                                    <div class="date-time">
                                                                        <h6 class="text-content">14 Jan, 2022 at
                                                                            12.58 AM</h6>

                                                                        <div class="product-rating">
                                                                            <ul class="rating">
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                       class="fill"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                       class="fill"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"
                                                                                       class="fill"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"></i>
                                                                                </li>
                                                                                <li>
                                                                                    <i data-feather="star"></i>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    <div class="reply">
                                                                        <p>Icing cookie carrot cake chocolate cake
                                                                            sugar plum jelly-o danish. Dragée dragée
                                                                            shortbread tootsie roll croissant muffin
                                                                            cake I love gummi bears. Candy canes ice
                                                                            cream caramels tiramisu marshmallow cake
                                                                            shortbread candy canes cookie.<a
                                                                                    href="javascript:void(0)">Reply</a>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp">
                <div class="right-sidebar-box">

                    <!-- Trending Product -->
                    <div class="pt-25">
                        <div class="category-menu">
                            <h3>Trending Products</h3>

                            <ul class="product-list product-right-sidebar border-0 p-0">

                                <?php
                                $query = "SELECT * FROM product order by rand() limit 6";

                                $data = $db_handle->runQuery($query);
                                $row_count = $db_handle->numRows($query);

                                for ($i = 0; $i < $row_count; $i = $i + 1) {
                                    $product_id = $data[$i]['id'];
                                    ?>
                                    <li>
                                        <div class="offer-product">
                                            <a href="<?php echo $extension; ?>product/<?php echo str_replace(' ', '-', $data[$i]['p_name']); ?>"
                                               class="offer-image">
                                                <img src="<?php echo $extension; ?><?php echo $data[$i]['main_image']; ?>"
                                                     class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <div class="offer-detail">
                                                <div>
                                                    <a href="<?php echo $extension; ?>product/<?php echo str_replace(' ', '-', $data[$i]['p_name']); ?>">
                                                        <h6 class="name"> <?php echo $data[$i]['p_name']; ?></h6>
                                                    </a>
                                                    <h6 class="price theme-color"><?php echo $money_symbol; ?><?php echo $data[$i]['p_price'] - $data[$i]['discount']; ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <!-- Banner Section -->
                    <div class="ratio_156 pt-25">
                        <div class="home-contain">
                            <img src="assets/images/vegetable/banner/8.jpg" class="bg-img blur-up lazyload"
                                 alt="">
                            <div class="home-detail p-top-left home-p-medium">
                                <div>
                                    <h6 class="text-yellow home-banner">Seafood</h6>
                                    <h3 class="text-uppercase fw-normal"><span
                                                class="theme-color fw-bold">Freshes</span> Products</h3>
                                    <h3 class="fw-light">every hour</h3>
                                    <button onclick="location.href = 'shop-left-sidebar.html';"
                                            class="btn btn-animation btn-md fw-bold mend-auto">Shop Now <i
                                                class="fa-solid fa-arrow-right icon"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Left Sidebar End -->

<!-- Releted Product Section Start -->
<section class="product-list-section section-b-space">
    <div class="container-fluid-lg">
        <div class="title">
            <h2>Related Products</h2>
            <span class="title-leaf">
                    <svg class="icon-width">
                        <use xlink:href="assets/images/leaf.svg#leaf"></use>
                    </svg>
                </span>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="slider-6_1 product-wrapper">


                    <?php
                    $query = "SELECT * FROM product order by rand() limit 9";

                    $data = $db_handle->runQuery($query);
                    $row_count = $db_handle->numRows($query);

                    for ($i = 0; $i < $row_count; $i = $i + 1) {
                        $product_id = $data[$i]['id'];
                        ?>
                        <div>
                            <div class="product-box product-box-bg wow fadeInUp">
                                <div class="product-image">
                                    <a onclick="showProduct(<?php echo $product_id; ?>);">
                                        <img src="<?php echo $extension; ?><?php echo $data[$i]['main_image']; ?>"
                                             class="img-fluid blur-up lazyload" alt="">
                                    </a>
                                    <ul class="product-option">
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="View"
                                            onclick="showProduct(<?php echo $product_id; ?>);">
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
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Releted Product Section End -->

<?php include('include/footer.php'); ?>

<?php include('include/footer.php'); ?>

<script>
    async function showProduct(id) {
        $.ajax({
            type: "POST",
            url: "<?php echo $extension; ?>fetch-product-modal",
            data: {
                id: id,
                extension:<?php if ($extension == '../') echo 1; else if ($extension == '../../') echo 2; else echo 0; ?>},
            success: async function (msg) {
                $("#showProduct").html(msg)
            },
            error: function () {
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
                            <img src="<?php echo $extension; ?>assets/images/product/category/1.jpg"
                                 class="img-fluid blur-up lazyload"
                                 alt="">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="right-sidebar-modal">
                            <h4 class="title-name">Peanut Butter Bite Premium Butter Cookies 600 g</h4>
                            <h4 class="price"><?php echo $money_symbol; ?>36.99</h4>

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

<!-- Add to cart Modal Start -->
<div class="add-cart-box">
    <div class="add-iamge">
        <img src="<?php echo $extension; ?>assets/images/cake/pro/1.jpg" class="img-fluid blur-up lazyload" alt="">
    </div>

    <div class="add-contain">
        <h6>Added to Cart</h6>
    </div>
</div>
<!-- Add to cart Modal End -->

<!-- Bg overlay Start -->
<div class="bg-overlay"></div>
<!-- Bg overlay End -->

<?php include('include/js.php'); ?>

</body>
</html>
