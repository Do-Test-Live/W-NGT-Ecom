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
    <meta name="description" content="<?php echo $site_name; ?>">
    <meta name="keywords" content="<?php echo $site_name; ?>">
    <meta name="author" content="<?php echo $site_name; ?>">
    <link rel="icon" href="<?php echo $extension; ?>assets/images/favicon/1.png" type="image/x-icon">
    <title>Search | <?php echo $site_name; ?></title>

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
                    <h2>Search</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="<?php echo $extension; ?>home">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Search</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Search Bar Section Start -->
<section class="search-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-6 col-xl-8 mx-auto">
                <div class="title d-block text-center">
                    <h2>Search for products</h2>
                    <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="<?php echo $extension; ?>assets/images/leaf.svg#leaf"></use>
                            </svg>
                        </span>
                </div>

                <form action="" method="post">
                    <div class="search-box">
                        <div class="input-group">
                            <input type="text" name="query" class="form-control" placeholder=""
                                   aria-label="Example text with button addon" required>
                            <button class="btn theme-bg-color text-white m-0" type="submit"
                                    id="button-addon1" name="search">Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Search Bar Section End -->

<!-- Product Section Start -->
<section class="section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">

                <div class="slider-6_1 product-wrapper">

                    <?php
                    if (isset($_POST['query'])) {
                        $query = "SELECT * FROM product where p_name like '%{$_POST['query']}%'";

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
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

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
