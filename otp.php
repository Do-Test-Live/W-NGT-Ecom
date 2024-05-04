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
                            <h5 class="text-content">A code has been sent to
                                <span>
                                    <?php if(isset($_GET['email'])){
                                        $emailParts = explode('@', $_GET['email']);

                                        if (count($emailParts) === 2) {
                                            // Obfuscate the first part of the email
                                            $username = $emailParts[0];
                                            $obfuscatedUsername = substr($username, 0, 2) . str_repeat('*', max(strlen($username) - 2, 0));

                                            // Combine the obfuscated username and the domain
                                            $obfuscatedEmail = $obfuscatedUsername . '@' . $emailParts[1];

                                            // Output the obfuscated email
                                            echo $obfuscatedEmail;
                                        }
                                    }  ?>
                                </span>
                            </h5>
                        </div>

                        <?php

                        if(isset($_GET['id'])){
                            $otp_id = $db_handle->checkValue($_GET['id']);
                            $updated_at = date('Y-m-d h:i:s');
                            $query = "UPDATE `user` SET `otp_id`='',`status`='1',`updated_at`='$updated_at' WHERE `otp_id`='$otp_id'";
                            $update = $db_handle->insertQuery($query);

                            if($update){
                                echo '<script>
                                        alert("Verified Successfully");
                                        window.location.href="login";
                                      </script>';
                            }
                        }
                        ?>

                        <form action="insert" method="post">
                            <div id="otp" class="inputs d-flex flex-row justify-content-center">
                                <input class="text-center form-control rounded" type="text" id="first" name="first"
                                       maxlength="1" placeholder="0">
                                <input class="text-center form-control rounded" type="text" id="second" name="second"
                                       maxlength="1" placeholder="0">
                                <input class="text-center form-control rounded" type="text" id="third" name="third"
                                       maxlength="1" placeholder="0">
                                <input class="text-center form-control rounded" type="text" id="fourth" name="fourth"
                                       maxlength="1" placeholder="0">
                                <input class="text-center form-control rounded" type="text" id="fifth" name="fifth"
                                       maxlength="1" placeholder="0">
                                <input class="text-center form-control rounded" type="text" id="sixth" name="sixth"
                                       maxlength="1" placeholder="0">
                            </div>

                            <input type="hidden" name="email" id="email" value="<?php echo $_GET['mail']; ?>" required>

                            <div class="send-box pt-4">
                                <h5>Didn't get the code? <a href="insert?resend=1&mail=<?php echo $_GET['mail']; ?>" class="theme-color fw-bold">Resend
                                        It</a></h5>
                            </div>

                            <button name="validate" class="btn btn-animation w-100 mt-3"
                                    type="submit">Validate
                            </button>
                        </form>
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
