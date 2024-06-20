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
    <link rel="icon" href="assets/images/favicon/1.png" type="image/x-icon">
    <title>Profile | <?php echo $site_name; ?></title>

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
                    <h2>User Dashboard</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="<?php echo $extension; ?>home">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">User Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<?php
$query="select * from user where id={$_SESSION['userid']}";
$user_info=$db_handle->runQuery($query);
?>

<!-- User Dashboard Section Start -->
<section class="user-dashboard-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-3 col-lg-4">
                <div class="dashboard-left-sidebar">
                    <div class="close-button d-flex d-lg-none">
                        <button class="close-sidebar">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="profile-box">
                        <div class="cover-image">
                            <img src="assets/images/inner-page/cover-img.jpg" class="img-fluid blur-up lazyload"
                                 alt="">
                        </div>

                        <div class="profile-contain">
                            <div class="profile-image">
                                <div class="position-relative">
                                    <img src="assets/images/inner-page/user/1.jpg"
                                         class="blur-up lazyload update_img" alt="">
                                    <div class="cover-icon">
                                        <i class="fa-solid fa-pen">
                                            <input type="file" onchange="readURL(this,0)">
                                        </i>
                                    </div>
                                </div>
                            </div>

                            <div class="profile-name">
                                <h3><?php echo $user_info[0]['name']; ?></h3>
                                <h6 class="text-content"><?php echo $user_info[0]['email']; ?></h6>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-dashboard-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-dashboard" type="button" role="tab"
                                    aria-controls="pills-dashboard" aria-selected="true"><i data-feather="home"></i>
                                DashBoard
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-order-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-order" type="button" role="tab" aria-controls="pills-order"
                                    aria-selected="false"><i data-feather="shopping-bag"></i>Order
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-wishlist-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-wishlist" type="button" role="tab"
                                    aria-controls="pills-wishlist" aria-selected="false"><i data-feather="heart"></i>
                                Wishlist
                            </button>
                        </li>


                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button" role="tab"
                                    aria-controls="pills-profile" aria-selected="false"><i data-feather="user"></i>
                                Profile
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xxl-9 col-lg-8">
                <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">Show
                    Menu
                </button>
                <div class="dashboard-right-sidebar">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel"
                             aria-labelledby="pills-dashboard-tab">
                            <div class="dashboard-home">
                                <div class="title">
                                    <h2>My Dashboard</h2>
                                    <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="assets/images/leaf.svg#leaf"></use>
                                            </svg>
                                        </span>
                                </div>

                                <div class="dashboard-user-name">
                                    <h6 class="text-content">Hello, <b class="text-title"><?php echo $user_info[0]['name']; ?></b></h6>
                                    <p class="text-content">From your My Account Dashboard you have the ability to
                                        view a snapshot of your recent account activity and update your account
                                        information. Select a link below to view or edit information.</p>
                                </div>

                                <div class="total-box">
                                    <div class="row g-sm-4 g-3">
                                        <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                            <div class="totle-contain">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/order.svg"
                                                     class="img-1 blur-up lazyload" alt="">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/order.svg"
                                                     class="blur-up lazyload"
                                                     alt="">
                                                <div class="totle-detail">
                                                    <h5>Total Order</h5>
                                                    <h3>3658</h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                            <div class="totle-contain">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/pending.svg"
                                                     class="img-1 blur-up lazyload" alt="">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/pending.svg"
                                                     class="blur-up lazyload"
                                                     alt="">
                                                <div class="totle-detail">
                                                    <h5>Total Pending Order</h5>
                                                    <h3>254</h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                            <div class="totle-contain">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/wishlist.svg"
                                                     class="img-1 blur-up lazyload" alt="">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/wishlist.svg"
                                                     class="blur-up lazyload" alt="">
                                                <div class="totle-detail">
                                                    <h5>Total Wishlist</h5>
                                                    <h3>32158</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="pills-wishlist" role="tabpanel"
                             aria-labelledby="pills-wishlist-tab">
                            <div class="dashboard-wishlist">
                                <div class="title">
                                    <h2>My Wishlist History</h2>
                                    <span class="title-leaf title-leaf-gray">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="assets/images/leaf.svg#leaf"></use>
                                            </svg>
                                        </span>
                                </div>
                                <div class="row g-sm-4 g-3">

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="pills-order" role="tabpanel"
                             aria-labelledby="pills-order-tab">
                            <div class="dashboard-order">
                                <div class="title">
                                    <h2>My Orders History</h2>
                                    <span class="title-leaf title-leaf-gray">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="assets/images/leaf.svg#leaf"></use>
                                            </svg>
                                        </span>
                                </div>

                                <div class="order-contain">
                                    <div class="order-box dashboard-bg-box">
                                        <div class="order-container">
                                            <div class="order-icon">
                                                <i data-feather="box"></i>
                                            </div>

                                            <div class="order-detail">
                                                <h4>Delivere <span>Panding</span></h4>
                                                <h6 class="text-content">Gouda parmesan caerphilly mozzarella
                                                    cottage cheese cauliflower cheese taleggio gouda.</h6>
                                            </div>
                                        </div>

                                        <div class="product-order-detail">
                                            <a href="product-left-thumbnail.html" class="order-image">
                                                <img src="assets/images/vegetable/product/1.png"
                                                     class="blur-up lazyload" alt="">
                                            </a>

                                            <div class="order-wrap">
                                                <a href="product-left-thumbnail.html">
                                                    <h3>Fantasy Crunchy Choco Chip Cookies</h3>
                                                </a>
                                                <p class="text-content">Cheddar dolcelatte gouda. Macaroni cheese
                                                    cheese strings feta halloumi cottage cheese jarlsberg cheese
                                                    triangles say cheese.</p>
                                                <ul class="product-size">
                                                    <li>
                                                        <div class="size-box">
                                                            <h6 class="text-content">Price : </h6>
                                                            <h5>$20.68</h5>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="size-box">
                                                            <h6 class="text-content">Rate : </h6>
                                                            <div class="product-rating ms-2">
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
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="size-box">
                                                            <h6 class="text-content">Sold By : </h6>
                                                            <h5>Fresho</h5>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="size-box">
                                                            <h6 class="text-content">Quantity : </h6>
                                                            <h5>250 G</h5>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="pills-profile" role="tabpanel"
                             aria-labelledby="pills-profile-tab">
                            <div class="dashboard-profile">
                                <div class="title">
                                    <h2>My Profile</h2>
                                    <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="assets/images/leaf.svg#leaf"></use>
                                            </svg>
                                        </span>
                                </div>
                                <div class="profile-detail dashboard-bg-box">
                                    <div class="dashboard-title">
                                        <h3>Profile Name</h3>
                                    </div>
                                    <div class="profile-name-detail">
                                        <div class="d-sm-flex align-items-center d-block">
                                            <h3><?php echo $user_info[0]['name']; ?></h3>
                                        </div>

                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                           data-bs-target="#editProfile">Edit</a>
                                    </div>

                                    <div class="location-profile">
                                        <ul>
                                            <li>
                                                <div class="location-box">
                                                    <i data-feather="mail"></i>
                                                    <h6><?php echo $user_info[0]['email']; ?></h6>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="profile-about dashboard-bg-box">
                                    <div class="row">
                                        <div class="col-xxl-7">
                                            <div class="dashboard-title mb-3">
                                                <h3>Profile About</h3>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <td>Gender :</td>
                                                        <td><?php echo $user_info[0]['gender']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Birthday :</td>
                                                        <td><?php echo date("d/m/Y", strtotime($user_info[0]['birthday'])); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phone Number :</td>
                                                        <td>
                                                            <a href="javascript:void(0)"><?php echo $user_info[0]['contact_number']; ?></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Address :</td>
                                                        <td><?php echo $user_info[0]['address']; ?></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col-xxl-5">
                                            <div class="profile-image">
                                                <img src="assets/images/inner-page/dashboard-profile.png"
                                                     class="img-fluid blur-up lazyload" alt="">
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
    </div>
</section>
<!-- User Dashboard Section End -->

<?php include('include/footer.php'); ?>

<!-- Bg overlay Start -->
<div class="bg-overlay"></div>
<!-- Bg overlay End -->

<!-- Edit Profile Start -->
<div class="modal fade theme-modal" id="editProfile" tabindex="-1" aria-labelledby="exampleModalLabel2"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-xxl-12">
                        <div class="form-floating theme-form-floating">
                            <input type="text" class="form-control" id="pname" value="<?php echo $user_info[0]['name']; ?>">
                            <label for="pname">Full Name</label>
                        </div>
                    </div>

                    <div class="col-xxl-6">
                        <div class="form-floating theme-form-floating">
                            <input type="email" class="form-control" id="email1" value="<?php echo $user_info[0]['email']; ?>" readonly
                                   required>
                            <label for="email1">Email address</label>
                        </div>
                    </div>

                    <div class="col-xxl-6">
                        <div class="form-floating theme-form-floating">
                            <input class="form-control" type="tel" value="<?php echo $user_info[0]['contact_number']; ?>" name="mobile" id="mobile"
                                   maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value =
                                            this.value.slice(0, this.maxLength);">
                            <label for="mobile">phone Number</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating theme-form-floating">
                            <input type="text" class="form-control" id="address1"
                                   value="<?php echo $user_info[0]['address']; ?>">
                            <label for="address1">Delivery Address</label>
                        </div>
                    </div>

                    <div class="col-xxl-6">
                        <div class="form-floating theme-form-floating">
                            <select class="form-select" id="floatingSelect1"
                                    aria-label="Floating label select example">
                                <option selected>Choose...</option>
                                <option value="Female" <?php if($user_info[0]['gender']=='Female') echo 'selected'; ?>>Female</option>
                                <option value="Male" <?php if($user_info[0]['gender']=='Male') echo 'selected'; ?>>Male</option>
                                <option value="Others" <?php if($user_info[0]['gender']=='Others') echo 'selected'; ?>>Others</option>
                            </select>
                            <label for="floatingSelect">Gender
                            </label>
                        </div>
                    </div>

                    <div class="col-xxl-6">
                        <div class="form-floating theme-form-floating">
                            <input type="date" class="form-control" value="<?php echo $user_info[0]['birthday']; ?>" id="birthdate">
                            <label for="birthdate">Birth Date</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-animation btn-md fw-bold"
                        data-bs-dismiss="modal">Close
                </button>
                <button type="button" data-bs-dismiss="modal"
                        class="btn theme-bg-color btn-md fw-bold text-light">Save changes
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Edit Profile End -->

<?php include('include/js.php'); ?>
</body>
</html>
