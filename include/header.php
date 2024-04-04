<?php
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_POST["quantity"])) {

                $productByCode = $db_handle->runQuery("SELECT * FROM product WHERE id='" . $_POST["product_id"] . "'");
                $itemArray = array('PP' . $productByCode[0]["id"] => array('name' => $productByCode[0]["p_name"], 'image' => $productByCode[0]["main_image"], 'product_id' => 'PP' . $productByCode[0]["id"], 'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["p_price"]));

                if (!empty($_SESSION["cart_item"])) {
                    if (in_array('PP' . $productByCode[0]["id"], array_keys($_SESSION["cart_item"]))) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ('PP' . $productByCode[0]["id"] == $k) {
                                if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }

                echo "<script>
                document.cookie = 'alert = 10;';
                </script>";

            }
            break;
        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($_GET["product_id"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    if (empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "update":
            if (!empty($_POST["quantity"]) && !empty($_POST["product_id"])) {
                // Loop through the submitted quantities and update the cart
                for ($i = 0; $i < count($_POST["product_id"]); $i++) {
                    $code = $_POST["product_id"][$i];
                    $quantity = $_POST["quantity"][$i];

                    // Ensure quantity is a positive integer
                    if (is_numeric($quantity) && $quantity > 0) {
                        if (isset($_SESSION["cart_item"][$code])) {
                            $_SESSION["cart_item"][$code]["quantity"] = $quantity;
                        }
                    }
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}

$total_quantity = 0;
$total_price = 0;
if (isset($_SESSION["cart_item"])) {
    foreach ($_SESSION["cart_item"] as $item) {
        $item_price = $item["quantity"] * $item["price"];
        $total_quantity += $item["quantity"];
        $total_price += ($item["price"] * $item["quantity"]);
    }
}
?>

<!-- Header Start -->
<header class="pb-md-4 pb-0">
    <div class="header-top">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-3 d-xxl-block d-none">
                    <div class="top-left-header">
                        <i class="fa-solid fa-location-dot text-white"></i>
                        <span class="text-white">Hong Kong</span>
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-9 d-lg-block d-none">
                    <div class="header-offer">
                        <div class="notification-slider">
                            <div>
                                <div class="timer-notification">
                                    <h6><strong class="me-1">Welcome To NGT-ECom!</strong>Wrap new offers/gift
                                        every signle day on Weekends.<strong class="ms-1">New Coupon Code: Fast024
                                        </strong>

                                    </h6>
                                </div>
                            </div>

                            <div>
                                <div class="timer-notification">
                                    <h6>Something you love is now on sale!
                                        <a href="shop" class="text-white">Buy Now
                                            !</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <ul class="about-list right-nav-about">
                        <li class="right-nav-list">
                            <div class="dropdown theme-form-select">
                                <button class="btn dropdown-toggle" type="button" id="select-language"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="assets/images/country/united-states.png"
                                         class="img-fluid blur-up lazyload" alt="">
                                    <span>English</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="select-language">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0)" id="english">
                                            <img src="assets/images/country/united-kingdom.png"
                                                 class="img-fluid blur-up lazyload" alt="">
                                            <span>English</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0)" id="france">
                                            <img src="assets/images/country/hk.png"
                                                 class="img-fluid blur-up lazyload" alt="">
                                            <span>Hong Kong</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="right-nav-list">
                            <div class="theme-form-select">
                                <button class="btn dropdown-toggle bill">
                                    <span>HKD</span>
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="top-nav top-header sticky-header">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="navbar-top">
                        <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                                <span class="navbar-toggler-icon">
                                    <i class="fa-solid fa-bars"></i>
                                </span>
                        </button>
                        <a href="home" class="web-logo nav-logo">
                            <img src="assets/images/logo/1.png" class="img-fluid blur-up lazyload" alt="">
                        </a>

                        <div class="middle-box">
                            <div class="search-box">
                                <div class="input-group">
                                    <input type="search" class="form-control" placeholder="I'm searching for..."
                                           aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn" type="button" id="button-addon2">
                                        <i data-feather="search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="rightside-box">
                            <div class="search-full">
                                <div class="input-group">
                                        <span class="input-group-text">
                                            <i data-feather="search" class="font-light"></i>
                                        </span>
                                    <input type="text" class="form-control search-type" placeholder="Search here..">
                                    <span class="input-group-text close-search">
                                            <i data-feather="x" class="font-light"></i>
                                        </span>
                                </div>
                            </div>
                            <ul class="right-side-menu">
                                <li class="right-side">
                                    <div class="delivery-login-box">
                                        <div class="delivery-icon">
                                            <div class="search-box">
                                                <i data-feather="search"></i>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="right-side">
                                    <a href="contact" class="delivery-login-box">
                                        <div class="delivery-icon">
                                            <i data-feather="phone-call"></i>
                                        </div>
                                        <div class="delivery-detail">
                                            <h6>24/7 Delivery</h6>
                                            <h5>+852 620 23824</h5>
                                        </div>
                                    </a>
                                </li>
                                <li class="right-side">
                                    <a href="wishlist" class="btn p-0 position-relative header-wishlist">
                                        <i data-feather="heart"></i>
                                    </a>
                                </li>
                                <li class="right-side">
                                    <div class="onhover-dropdown header-badge">
                                        <button type="button" class="btn p-0 position-relative header-wishlist">
                                            <i data-feather="shopping-cart"></i>
                                            <span class="position-absolute top-0 start-100 translate-middle badge"><?php echo $total_quantity; ?>
                                                    <span class="visually-hidden">unread messages</span>
                                                </span>
                                        </button>

                                        <div class="onhover-div">
                                            <ul class="cart-list">
                                                <?php
                                                if (isset($_SESSION["cart_item"])) {
                                                    foreach ($_SESSION["cart_item"] as $item) {
                                                        $item_price = $item["quantity"] * $item["price"];
                                                        ?>
                                                        <li class="product-box-contain">
                                                            <div class="drop-cart">
                                                                <a href="product" class="drop-image">
                                                                    <img src="<?php echo $item["image"]; ?>"
                                                                         class="blur-up lazyload" alt="">
                                                                </a>

                                                                <div class="drop-contain">
                                                                    <a href="product">
                                                                        <h5><?php echo $item["name"]; ?></h5>
                                                                    </a>
                                                                    <h6><span><?php echo $item["quantity"]; ?> x</span>
                                                                        $<?php echo $item["price"]; ?></h6>
                                                                    <button onclick="location.href = '?action=remove&product_id=<?php echo $item["product_id"]; ?>'"
                                                                       class="close-button close_button">
                                                                        <i class="fa-solid fa-xmark"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>

                                            <div class="price-box">
                                                <h5>Total :</h5>
                                                <h4 class="theme-color fw-bold"><?php echo '$' . $total_price; ?></h4>
                                            </div>

                                            <div class="button-group">
                                                <a href="cart" class="btn btn-sm cart-button">View Cart</a>
                                                <a href="checkout" class="btn btn-sm cart-button theme-bg-color
                                                    text-white">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="right-side onhover-dropdown">
                                    <div class="delivery-login-box">
                                        <div class="delivery-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                        <div class="delivery-detail">
                                            <h6>Hello,</h6>
                                            <h5>My Account</h5>
                                        </div>
                                    </div>

                                    <div class="onhover-div onhover-div-login">
                                        <ul class="user-box-name">
                                            <li class="product-box-contain">
                                                <i></i>
                                                <a href="login">Log In</a>
                                            </li>

                                            <li class="product-box-contain">
                                                <a href="signup">Register</a>
                                            </li>

                                            <li class="product-box-contain">
                                                <a href="forgot-password">Forgot Password</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="header-nav">
                    <div class="header-nav-left">
                        <button class="dropdown-category">
                            <i data-feather="align-left"></i>
                            <span>All Categories</span>
                        </button>

                        <div class="category-dropdown">
                            <div class="category-title">
                                <h5>Categories</h5>
                                <button type="button" class="btn p-0 close-button text-content">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>

                            <ul class="category-list">
                                <?php

                                $query = "SELECT * FROM category order by id";

                                $category = $db_handle->runQuery($query);
                                $row_count = $db_handle->numRows($query);

                                for ($i = 0; $i < $row_count; $i++) {
                                    $category_id = $category[$i]['id'];
                                    ?>
                                    <li class="onhover-category-list">
                                        <a href="javascript:void(0)" class="category-name text-start">
                                            <?php echo $category[$i]['c_icon']; ?>
                                            <h6><?php echo $category[$i]['c_name']; ?></h6>
                                            <i class="fa-solid fa-angle-right"></i>
                                        </a>

                                        <div class="onhover-category-box">
                                            <div class="list-1">
                                                <div class="category-title-box">
                                                    <h5><?php echo $category[$i]['c_name']; ?></h5>
                                                </div>
                                                <ul>
                                                    <?php
                                                    $query = "SELECT * FROM subcategory where category_id='$category_id' order by id";
                                                    $subCategory = $db_handle->runQuery($query);
                                                    $row = $db_handle->numRows($query);

                                                    $halfRow = ceil($row / 2);

                                                    for ($j = 0; $j < $row && $j < $halfRow; $j++) {
                                                        $subCategory_id = $subCategory[$j]['id'];
                                                        ?>
                                                        <li>
                                                            <a href="javascript:void(0)"><?php echo $subCategory[$j]['s_name']; ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>

                                            <div class="list-2">
                                                <div class="category-title-box">
                                                    <h5></h5>
                                                </div>
                                                <ul style="margin-top: 35px !important;">
                                                    <?php
                                                    for ($j = $halfRow; $j < $row; $j++) {
                                                        $subCategory_id = $subCategory[$j]['id'];
                                                        ?>
                                                        <li>
                                                            <a href="javascript:void(0)"><?php echo $subCategory[$j]['s_name']; ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="header-nav-middle">
                        <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                            <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                                <div class="offcanvas-header navbar-shadow">
                                    <h5>Menu</h5>
                                    <button class="btn-close lead" type="button" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link" href="home">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="shop">Shop</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="faq">FAQ</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="about">About</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="contact">Contact</a>
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
</header>
<!-- Header End -->

<!-- mobile fix menu start -->
<div class="mobile-menu d-md-none d-block mobile-cart"
     style="background: #0da487;padding-top:17px;padding-bottom: 17px">
    <ul>
        <li class="">
            <a href="home">
                <i class="fa-solid fa-house text-white" style="font-size: 18px"></i>
            </a>
        </li>

        <li class="mobile-category">
            <a href="javascript:void(0)">
                <i class="fa-solid fa-bag-shopping text-white" style="font-size: 18px"></i>
            </a>
        </li>

        <li>
            <a href="search" class="search-box">
                <i class="fa-solid fa-magnifying-glass text-white" style="font-size: 18px"></i>
            </a>
        </li>
        <li>
            <a href="cart">
                <i class="fa-solid fa-cart-shopping text-white" style="font-size: 18px"></i>
            </a>
        </li>
    </ul>
</div>
<!-- mobile fix menu end -->
