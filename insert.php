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

if(isset($_POST['checkout'])){
    $user_id=$_SESSION['userid'];
    $promo_id=0;
    $order_status=0;

    $insert_billing_details = $db_handle->insertQuery("INSERT INTO `billing_details`(`user_id`, `promo_code_id`, `order_status`, `inserted_at`, `updated_at`) VALUES ('$user_id','$promo_id','$order_status','$inserted_at','$updated_at')");


    $billing = $db_handle->runQuery("SELECT * FROM billing_details order by id desc limit 1");

    $billing_id = $billing[0]["id"];

    $table='';
    $sl=1;

    $total_price=0;

    foreach ($_SESSION["cart_item"] as $item) {
            $name = $item["name"];
            $item_price = $item["quantity"] * $item["price"];
            $quantity = $item["quantity"];
            $unit_price = $item["price"];
            $product_id = $item['product_id'];

            $table.='<tr>
                        <td>'.$sl.'</td>
                        <td>'.$name.'</td>
                        <td>'.$quantity.'</td>
                        <td>'.$money_symbol.$unit_price.'</td>
                        <td>'.$money_symbol.$item_price.'</td>
                     </tr>';

            $sl=$sl+1;
            $total_price+=$item_price;
            $invoice = $db_handle->insertQuery("INSERT INTO `invoice`(`user_id`, `billing_id`, `product_id`, `product_name`, `product_quantity`, `price`, `total`, `inserted_at`) VALUES ('$user_id','$billing_id','$product_id','$name','$quantity','$unit_price','$item_price', '$updated_at')");
    }
    unset($_SESSION["cart_item"]);

    $messege = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Invoice</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 0;
                        padding: 0;
                        background-color: #f4f4f4;
                    }
                    .container {
                        width: 100%;
                        max-width: 700px;
                        margin: 30px auto;
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 8px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
                    .header {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        padding: 20px 0;
                        border-bottom: 1px solid #ddd;
                    }
                    .header h1 {
                        margin: 0;
                        font-size: 28px;
                        color: #333;
                    }
                    .header img {
                        max-width: 150px;
                    }
                    .invoice-details, .invoice-items {
                        width: 100%;
                        margin: 20px 0;
                        border-collapse: collapse;
                    }
                    .invoice-details td, .invoice-items th, .invoice-items td {
                        padding: 10px;
                        border: 1px solid #ddd;
                    }
                    .invoice-details td {
                        width: 50%;
                        vertical-align: top;
                    }
                    .invoice-items th {
                        background-color: #f2f2f2;
                        text-align: left;
                    }
                    .invoice-items td {
                        text-align: right;
                    }
                    .invoice-items td:first-child {
                        text-align: left;
                    }
                    .summary {
                        width: 100%;
                        margin: 20px 0;
                        border-collapse: collapse;
                        display: flex;
                        justify-content: space-between;
                    }
                    .summary-left, .summary-right {
                        width: 48%;
                    }
                    .summary-left, .summary-right {
                        padding: 10px;
                    }
                    .summary-left table, .summary-right table {
                        width: 100%;
                    }
                    .summary-left td, .summary-right td {
                        padding: 10px;
                        border: none;
                        text-align: right;
                    }
                    .summary-left td:first-child, .summary-right td:first-child {
                        text-align: left;
                    }
                    .summary .total-row {
                        font-size: 18px;
                        border-top: 2px solid #333;
                    }
                    .footer {
                        padding: 20px 0;
                        border-top: 1px solid #ddd;
                        color: #888;
                        display: flex;
                        justify-content: space-between;
                    }
                    .company-details, .company-signature {
                        font-size: 14px;
                        color: #333;
                    }
                    .payment-info {
                        font-size: 14px;
                        color: #333;
                    }
                    @media only screen and (max-width: 600px) {
                        .container {
                            padding: 10px;
                        }
                        .header {
                            flex-direction: column;
                            align-items: flex-start;
                        }
                        .header img {
                            margin-top: 10px;
                        }
                        .invoice-details td, .invoice-items th, .invoice-items td, .summary td {
                            padding: 8px;
                        }
                        .summary {
                            flex-direction: column;
                        }
                        .summary-left, .summary-right {
                            width: 100%;
                        }
                        .summary .total-row {
                            font-size: 16px;
                        }
                        .footer {
                            flex-direction: column;
                            align-items: flex-start;
                        }
                        .company-signature {
                            text-align: left;
                        }
                    }
                </style>
            </head>
            <body>
            <div class="container">
                <div class="header">
                    <h1>Invoice</h1>
                    <img src="https://via.placeholder.com/150" alt="Company Logo">
                </div>
                <table class="invoice-details">
                    <tr>
                        <td>
                            <strong>To:</strong><br>
                            Customer Name<br>
                            456 Customer Address<br>
                            City, State, ZIP Code<br>
                            Email: customer@example.com
                        </td>
                        <td>
                            <strong>Invoice Number:</strong><br>
                            INV-123456<br><br>
                            <strong>Invoice Date:</strong><br>
                            May 18, 2024
                        </td>
                    </tr>
                </table>
                <table class="invoice-items">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    '.$table.'
                    </tbody>
                </table>
                <div class="summary">
                    <div class="summary-left payment-info">
                        <strong>Payment Information</strong><br>
                        Bank: Your Bank Name<br>
                        Account Number: 123456789<br>
                        SWIFT: ABCD1234<br>
                        IBAN: XY00BANK123456789
                    </div>
                    <div class="summary-right">
                        <table>
                            <tr>
                                <td>Subtotal:</td>
                                <td>$200.00</td>
                            </tr>
                            <tr>
                                <td>Discount (10%):</td>
                                <td>-$20.00</td>
                            </tr>
                            <tr>
                                <td>Tax (10%):</td>
                                <td>$18.00</td>
                            </tr>
                            <tr class="total-row">
                                <td><strong>Total:</strong></td>
                                <td><strong>'.$money_symbol.$total_price.'</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="footer">
                    <div class="company-details">
                        <strong>Company Name</strong><br>
                        123 Street Address<br>
                        City, State, ZIP Code<br>
                        Email: company@example.com<br>
                        Phone: (123) 456-7890<br>
                        Website: www.company.com
                    </div>
                    <div class="company-signature">
                        <strong>Company Signature:</strong><br><br><br>
                        __________________________<br>
                        Your Name<br>
                        Position
                    </div>
                </div>
            </div>
            </body>
            </html>
    ';

    $sender_name = $site_name;
    $sender_email = $db_handle->sender_email();
    $username = $db_handle->email_username();
    $password = $db_handle->email_password();
    $receiver_email = 'monoget1@gmail.com';


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

    if($insert_billing_details && $mail->send() ){
        echo '<script>
                alert("Order Successful");
                window.location.href="home"
              </script>';
    }
}