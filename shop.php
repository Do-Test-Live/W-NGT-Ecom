<?php
session_start();
require_once('include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NGT-ECom">
    <meta name="keywords" content="NGT-ECom">
    <meta name="author" content="NGT-ECom">
    <link rel="icon" href="assets/images/favicon/1.png" type="image/x-icon">
    <title>Shop | NGT-ECom</title>

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
                    <h2>Shop Category</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="index.html">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Shop Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Start -->
<section class="section-b-space shop-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-custome-3">
                <div class="left-box wow fadeInUp">
                    <div class="shop-left-sidebar">
                        <ul class="nav nav-pills mb-3 custom-nav-tab" id="pills-tab" role="tablist">
                            <?php

                            $query = "SELECT * FROM category order by id";

                            $category = $db_handle->runQuery($query);
                            $row_count = $db_handle->numRows($query);

                            for ($i = 0; $i < $row_count; $i++) {
                            $category_id = $category[$i]['id'];
                            ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-<?php echo $category[$i]['c_name']; ?>" data-bs-toggle="pill"
                                            data-bs-target="#pills-<?php echo $category[$i]['c_name']; ?>" type="button" role="tab"
                                            aria-selected="true"><?php echo $category[$i]['c_name']; ?> <img
                                                src="<?php echo $category[$i]['c_shop_image']; ?>"
                                                class="blur-up lazyload" alt=""></button>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-custome-9">
                <div class="show-button">
                    <div class="filter-button d-inline-block d-lg-none">
                        <a><i class="fa-solid fa-filter"></i> Filter Menu</a>
                    </div>

                    <div class="top-filter-menu">

                        <div class="grid-option d-none d-md-block">
                            <ul>
                                <li class="three-grid">
                                    <a href="javascript:void(0)">
                                        <img src="assets/images/svg/grid-3.svg"
                                             class="blur-up lazyload" alt="">
                                    </a>
                                </li>
                                <li class="grid-btn d-xxl-inline-block d-none active">
                                    <a href="javascript:void(0)">
                                        <img src="assets/images/svg/grid-4.svg"
                                             class="blur-up lazyload d-lg-inline-block d-none" alt="">
                                        <img src="assets/images/svg/grid.svg"
                                             class="blur-up lazyload img-fluid d-lg-none d-inline-block" alt="">
                                    </a>
                                </li>
                                <li class="list-btn">
                                    <a href="javascript:void(0)">
                                        <img src="assets/images/svg/list.svg"
                                             class="blur-up lazyload" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div
                        class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">

                    <?php
                    $query = "SELECT * FROM product as p, category as c where p.category_id=c.id order by rand() limit 16";

                    $data = $db_handle->runQuery($query);
                    $row_count = $db_handle->numRows($query);

                    for ($i = 0; $i < $row_count; $i = $i + 1) {
                    $product_id = $data[$i]['id'];
                    ?>
                        <div>
                            <div class="product-box-3 h-100 wow fadeInUp">
                                <div class="product-header">
                                    <div class="product-image">
                                        <a onclick="showProduct(<?php echo $product_id; ?>);">
                                            <img src="<?php echo $data[$i]['main_image']; ?>"
                                                 class="img-fluid blur-up lazyload" alt="">
                                        </a>
                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                <a onclick="showProduct(<?php echo $product_id; ?>);" data-bs-toggle="modal"
                                                   data-bs-target="#view">
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
                                </div>
                                <div class="product-footer">
                                    <div class="product-detail">
                                        <span class="span-name"><?php echo $data[$i]['c_name']; ?></span>
                                        <a onclick="showProduct(<?php echo $product_id; ?>);">
                                            <h5 class="name"><?php echo $data[$i]['p_name']; ?></h5>
                                        </a>
                                        <p class="text-content mt-1 mb-2 product-content">
                                            <?php echo $data[$i]['description']; ?>
                                        </p>
                                        <h6 class="unit">250 ml</h6>
                                        <h5 class="price"><span class="theme-color">$<?php echo $data[$i]['p_price'] - $data[$i]['discount']; ?></span>
                                            <del>
                                                <?php
                                                if ($data[$i]['p_price'] != ($data[$i]['p_price'] - $data[$i]['discount'])) {
                                                    echo $data[$i]['p_price'];
                                                }
                                                ?>
                                            </del>
                                        </h5>
                                        <div class="add-to-cart-box bg-white">
                                            <button class="btn btn-add-cart">Add to Cart
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

                <nav class="custome-pagination">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="javascript:void(0)" tabindex="-1" aria-disabled="true">
                                <i class="fa-solid fa-angles-left"></i>
                            </a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="javascript:void(0)">1</a>
                        </li>
                        <li class="page-item" aria-current="page">
                            <a class="page-link" href="javascript:void(0)">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->

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

<!-- Add to cart Modal Start -->
<div class="add-cart-box">
    <div class="add-iamge">
        <img src="assets/images/cake/pro/1.jpg" class="img-fluid blur-up lazyload" alt="">
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
