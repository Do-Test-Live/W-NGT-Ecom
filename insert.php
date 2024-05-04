<?php
session_start();
require_once('include/dbController.php');
$db_handle = new DBController();
require_once('include/settings.php');
require_once('include/cart-calculation.php');
date_default_timezone_set("Asia/Hong_Kong");
$extension = '';

$inserted_at = date('Y-m-d h:i:s');
$updated_at = date('Y-m-d h:i:s');

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function generateRandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    $charLength = strlen($characters);
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charLength - 1)];
    }
    return $randomString;
}


if (isset($_POST['signup'])) {
    $fullname = $db_handle->checkValue($_POST['fullname']);
    $email = $db_handle->checkValue($_POST['email']);
    $user_password = $db_handle->checkValue($_POST['password']);
    $cnfrm_password = $db_handle->checkValue($_POST['cnfrm_password']);
    $gender = $db_handle->checkValue($_POST['gender']);
    $birthday = $db_handle->checkValue($_POST['birthday']);
    $contact = $db_handle->checkValue($_POST['contact']);
    $address = $db_handle->checkValue($_POST['address']);
    $verification_code = generateRandomString(6);
    $otp_id = generateRandomString(20);

    $query = "select * from user where email='$email'";
    $row = $db_handle->numRows($query);


    $subject = $site_name;
    $year = date('Y');

    $domain = 'W-NGT-Ecom/';

    if ($_SERVER['SERVER_NAME'] == "www.ecom.frogbid.com" || $_SERVER['SERVER_NAME'] == "ecom.frogbid.com") {
        $domain = '';
    }

    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $serverName = $_SERVER['SERVER_NAME'];
    $url = $protocol . "://" . $serverName . "/" . $domain;

    $messege = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>OTP Verification</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 0;
                        padding: 0;
                        background-color: #f7f7f7;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                        background-color: #fff;
                        border-radius: 10px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
                    h1, h2, h3, p {
                        margin: 0;
                    }
                    .header {
                        background-color: #4CAF50;
                        color: #fff;
                        text-align: center;
                        padding: 20px;
                        border-top-left-radius: 10px;
                        border-top-right-radius: 10px;
                    }
                    .otp-section {
                        padding: 20px;
                        background-color: #f2f2f2;
                        border-radius: 5px;
                        margin-bottom: 20px;
                    }
                    .button-container {
                        text-align: center;
                        margin-bottom:15px;
                    }
                    a.btn {
                        display: inline-block;
                        background-color: #4CAF50;
                        color: white;
                        padding: 10px 4rem;
                        text-align: center;
                        text-decoration: none;
                        border-radius: 5px;
                        margin-top: 20px;
                    }
                    .footer {
                        background-color: #333;
                        color: #fff;
                        padding: 10px;
                        border-bottom-left-radius: 10px;
                        border-bottom-right-radius: 10px;
                    }
                    .footer p {
                        margin: 0;
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h1>OTP Verification</h1>
                    </div>
            
                    <div class="otp-section">
                        <p>Your OTP is: <strong>' . $verification_code . '</strong></p>
                        <p>Please use the above OTP to verify your email address.</p>
                        <p>Or click the Button below to verify without otp.</p>
                    </div>
            
                    <div class="button-container">
                        <!-- Verify button -->
                        <a href="' . $url . 'otp?id=' . $otp_id . '" class="btn">Verify</a>
                </div>
                    <div class="footer">
                        <p>&copy; ' . $year . ' ' . $site_name . ' All rights reserved.</p>
                    </div>
                </div>
            </body>
            </html>
    ';


    $sender_name = $site_name;
    $sender_email = $db_handle->sender_email();
    $username = $db_handle->email_username();
    $password = $db_handle->email_password();

    $receiver_email = $email;


    $mail = new PHPMailer(true);
    $mail->isSMTP();
    //$mail->SMTPDebug = 2;
    $mail->Host = $db_handle->email_host();
    $mail->SMTPAuth = true;

    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom($sender_email, $sender_name);
    $mail->Username = $username;
    $mail->Password = $password;

    $mail->CharSet = 'UTF-8';

    $mail->Subject = $subject;
    $mail->msgHTML($messege);
    $mail->addAddress($receiver_email);

    if ($user_password != $cnfrm_password) {
        echo '<script>
                alert("Password Not Match");
                window.location.href="signup";
              </script>';
    } else if ($row > 0) {
        echo '<script>
                alert("Email already registered");
                window.location.href="signup";
              </script>';
    } else {
        $user_password = md5($user_password);

        $query = "INSERT INTO `user`(`name`, `email`, `pass`, `gender`, `birthday`, `contact_number`, `address`,  `verification_code`, `otp_id`, `status`, `inserted_at`, `updated_at`) VALUES ('$fullname','$email','$user_password','$gender','$birthday','$contact','$address','$verification_code','$otp_id','0','$inserted_at','$updated_at')";
        $insert = $db_handle->insertQuery($query);

        if ($insert && $mail->send()) {
            echo '<script>
                alert("Register Succesfully");
                window.location.href="otp?mail=' . $email . '";
              </script>';
        }
    }
}

if(isset($_GET['resend'])){
    $verification_code = generateRandomString(6);
    $otp_id = generateRandomString(20);

    $email = $db_handle->checkValue($_GET['mail']);

    $subject = $site_name;
    $year = date('Y');

    $domain = 'W-NGT-Ecom/';

    if ($_SERVER['SERVER_NAME'] == "www.ecom.frogbid.com" || $_SERVER['SERVER_NAME'] == "ecom.frogbid.com") {
        $domain = '';
    }

    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $serverName = $_SERVER['SERVER_NAME'];
    $url = $protocol . "://" . $serverName . "/" . $domain;

    $messege = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>OTP Verification</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 0;
                        padding: 0;
                        background-color: #f7f7f7;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                        background-color: #fff;
                        border-radius: 10px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
                    h1, h2, h3, p {
                        margin: 0;
                    }
                    .header {
                        background-color: #4CAF50;
                        color: #fff;
                        text-align: center;
                        padding: 20px;
                        border-top-left-radius: 10px;
                        border-top-right-radius: 10px;
                    }
                    .otp-section {
                        padding: 20px;
                        background-color: #f2f2f2;
                        border-radius: 5px;
                        margin-bottom: 20px;
                    }
                    .button-container {
                        text-align: center;
                        margin-bottom:15px;
                    }
                    a.btn {
                        display: inline-block;
                        background-color: #4CAF50;
                        color: white;
                        padding: 10px 4rem;
                        text-align: center;
                        text-decoration: none;
                        border-radius: 5px;
                        margin-top: 20px;
                    }
                    .footer {
                        background-color: #333;
                        color: #fff;
                        padding: 10px;
                        border-bottom-left-radius: 10px;
                        border-bottom-right-radius: 10px;
                    }
                    .footer p {
                        margin: 0;
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h1>OTP Verification</h1>
                    </div>
            
                    <div class="otp-section">
                        <p>Your OTP is: <strong>' . $verification_code . '</strong></p>
                        <p>Please use the above OTP to verify your email address.</p>
                        <p>Or click the Button below to verify without otp.</p>
                    </div>
            
                    <div class="button-container">
                        <!-- Verify button -->
                        <a href="' . $url . 'otp?id=' . $otp_id . '" class="btn">Verify</a>
                </div>
                    <div class="footer">
                        <p>&copy; ' . $year . ' ' . $site_name . ' All rights reserved.</p>
                    </div>
                </div>
            </body>
            </html>
    ';


    $sender_name = $site_name;
    $sender_email = $db_handle->sender_email();
    $username = $db_handle->email_username();
    $password = $db_handle->email_password();
    $receiver_email = $email;


    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $db_handle->email_host();
    $mail->SMTPAuth = true;

    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom($sender_email, $sender_name);
    $mail->Username = $username;
    $mail->Password = $password;

    $mail->CharSet = 'UTF-8';

    $mail->Subject = $subject;
    $mail->msgHTML($messege);
    $mail->addAddress($receiver_email);

    $query = "UPDATE `user` SET `verification_code`='$verification_code',`otp_id`='$otp_id',`updated_at`='$updated_at' WHERE `email`='$email'";
    $update = $db_handle->insertQuery($query);

    if ($update && $mail->send()) {
        echo '<script>
                alert("Resend Succesfully");
                window.location.href="otp?mail=' . $email . '"
              </script>';
    }
}

if(isset($_POST['validate'])){
    $email = $_POST['email'];

    $firstValue = $_POST['first'];
    $secondValue = $_POST['second'];
    $thirdValue = $_POST['third'];
    $fourthValue = $_POST['fourth'];
    $fifthValue = $_POST['fifth'];
    $sixthValue = $_POST['sixth'];

    $otp = $firstValue . $secondValue . $thirdValue . $fourthValue . $fifthValue . $sixthValue;

    $query = "UPDATE `user` SET `otp_id`='',`status`='1',`updated_at`='$updated_at' WHERE `email`='$email' and `verification_code`='$otp'";
    $update = $db_handle->insertQuery($query);

    if($update){
        echo '<script>
                alert("Verified Successfully");
                window.location.href="login";
              </script>';
    }
}