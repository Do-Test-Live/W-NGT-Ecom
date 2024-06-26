<?php
session_start();
require_once('include/dbController.php');
$db_handle = new DBController();
require_once('include/settings.php');
require_once('include/cart-calculation.php');
date_default_timezone_set("Asia/Hong_Kong");
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
    <title>Sign Up | <?php echo $site_name; ?></title>

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
                    <h2>Sign In</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="<?php echo $extension; ?>home">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Sign In</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- log in section start -->
<section class="log-in-section section-b-space">
    <div class="container-fluid-lg w-100">
        <div class="row">
            <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                <div class="image-contain">
                    <img src="<?php echo $extension; ?>assets/images/inner-page/sign-up.png" class="img-fluid" alt="">
                </div>
            </div>

            <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                <div class="log-in-box">
                    <div class="log-in-title">
                        <h3>Welcome To <?php echo $site_name; ?></h3>
                        <h4>Create New Account</h4>
                    </div>

                    <div class="input-box">
                        <form class="row g-4" action="insert" method="post">
                            <div class="col-12">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" name="fullname"
                                           id="fullname" placeholder="Full Name" required autocomplete="off">
                                    <label for="fullname">Full Name <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating theme-form-floating">
                                    <select id="gender" name="gender" class="form-select" required>
                                        <option disabled selected>Choose..</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <label for="gender">Gender <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating theme-form-floating">
                                    <input type="date" class="form-control" name="birthday"
                                           id="birthday" required autocomplete="off">
                                    <label for="birthday">Birthday <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating theme-form-floating">
                                    <input type="email" class="form-control" name="email"
                                           id="email" placeholder="Email Address" required autocomplete="off">
                                    <label for="email">Email Address <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating theme-form-floating">
                                    <input type="password" class="form-control" id="password"
                                           name="password" placeholder="Password" required autocomplete="off">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating theme-form-floating">
                                    <input type="password" class="form-control" id="cnfrm_password"
                                           name="cnfrm_password" placeholder="Password" required autocomplete="off">
                                    <label for="cnfrm_password">Confirm Password <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" name="contact"
                                           id="contact" placeholder="Contact Number" required autocomplete="off">
                                    <label for="contact">Contact Number <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" name="address"
                                           id="address" placeholder="Address" required autocomplete="off">
                                    <label for="address">Address <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="forgot-box">
                                    <div class="form-check ps-0 m-0 remember-box">
                                        <input class="checkbox_animated check-box" type="checkbox"
                                               id="flexCheckDefault" required>
                                        <label class="form-check-label" for="flexCheckDefault">I agree with
                                            <span>Terms</span> and <span>Privacy</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-animation w-100" name="signup" type="submit">Sign Up</button>
                            </div>
                        </form>
                    </div>

                    <div class="other-log-in">
                        <h6></h6>
                    </div>

                    <div class="sign-up-box">
                        <h4>Already have an account?</h4>
                        <a href="login">Log In</a>
                    </div>
                </div>
            </div>

            <div class="col-xxl-7 col-xl-6 col-lg-6"></div>
        </div>
    </div>
</section>
<!-- log in section end -->

<?php include('include/footer.php'); ?>

<!-- Bg overlay Start -->
<div class="bg-overlay"></div>
<!-- Bg overlay End -->

<?php include('include/js.php'); ?>
</body>
</html>
