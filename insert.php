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
    $password = md5($db_handle->checkValue($_POST['password']));
    $cnfrm_password = md5($db_handle->checkValue($_POST['cnfrm_password']));
    $gender = $db_handle->checkValue($_POST['gender']);
    $birthday = $db_handle->checkValue($_POST['birthday']);
    $contact = $db_handle->checkValue($_POST['contact']);
    $address = $db_handle->checkValue($_POST['address']);
    $verification_code = generateRandomString(6);
    $otp_id = generateRandomString(20);

    $query = "select * from user where email='$email'";
    $row = $db_handle->numRows($query);

    if ($password != $cnfrm_password) {
        echo '<script>
                alert("Password Not Match");
                window.location.href="signup"
              </script>';
    } else if ($row > 0) {
        echo '<script>
                alert("Email already registered");
                window.location.href="signup"
              </script>';
    } else {
        $query = "INSERT INTO `user`(`name`, `email`, `pass`, `gender`, `birthday`, `contact_number`, `address`,  `verification_code`, `otp_id`, `status`, `inserted_at`, `updated_at`) VALUES ('$fullname','$email','$password','$gender','$birthday','$contact','$address','$verification_code','$otp_id','0','$inserted_at','$updated_at')";
        $insert = $db_handle->insertQuery($query);

        if ($insert) {
            echo '<script>
                alert("Register Succesfully");
                window.location.href="otp?id=' . $otp_id . '"
              </script>';
        }
    }
}