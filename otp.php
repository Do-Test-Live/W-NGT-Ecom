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
    <title>OTP | <?php echo $site_name; ?></title>

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
                    <h2>OTP</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="<?php echo $extension; ?>home">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active">OTP</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- log in section start -->
<section class="log-in-section otp-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                <div class="image-contain">
                    <img src="assets/images/inner-page/otp.png" class="img-fluid" alt="">
                </div>
            </div>

            <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                <div class="d-flex align-items-center justify-content-center h-100">
                    <div class="log-in-box">
                        <div class="log-in-title">
                            <h3 class="text-title">Please enter the one time password to verify your account</h3>
                            <h5 class="text-content">A code has been sent to <span>*******9897</span></h5>
                        </div>

                        <div id="otp" class="inputs d-flex flex-row justify-content-center">
                            <input class="text-center form-control rounded" type="text" id="first" maxlength="1"
                                   placeholder="0">
                            <input class="text-center form-control rounded" type="text" id="second" maxlength="1"
                                   placeholder="0">
                            <input class="text-center form-control rounded" type="text" id="third" maxlength="1"
                                   placeholder="0">
                            <input class="text-center form-control rounded" type="text" id="fourth" maxlength="1"
                                   placeholder="0">
                            <input class="text-center form-control rounded" type="text" id="fifth" maxlength="1"
                                   placeholder="0">
                            <input class="text-center form-control rounded" type="text" id="sixth" maxlength="1"
                                   placeholder="0">
                        </div>

                        <div class="send-box pt-4">
                            <h5>Didn't get the code? <a href="javascript:void(0)" class="theme-color fw-bold">Resend
                                    It</a></h5>
                        </div>

                        <button onclick="location.href = 'index.html';" class="btn btn-animation w-100 mt-3"
                                type="submit">Validate
                        </button>
                    </div>
                </div>
            </div>
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
